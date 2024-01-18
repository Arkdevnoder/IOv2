<?php

namespace Arknet\IO\Converter;

use Arknet\IO\Fragment;
use Arknet\IO\Math\PictureDivider;
use Arknet\IO\Formalizer\Converter;
use Arknet\IO\Trait\DefaultSetting;
use Arknet\IO\Trait\EntryFragmentProperty;
use Arknet\IO\Initializer\RasterDefiner;
use Arknet\IO\Initializer\ChunkSelector;
use Arknet\IO\Initializer\BaseConfiguration;

class Splitter implements Converter
{
    use EntryFragmentProperty;

    private PictureDivider $pictureDivider;
    private array $factorArray;
    private int $xParts;
    private int $yParts;
    private array $contents;
    private array $curlHandlers;
    private \CurlMultiHandle $curlHandler;

    public function __construct(BaseConfiguration $baseConfiguration)
    {
        $this->fromPath = $baseConfiguration->getFromPath();
        $this->chunkHandlerURL = $baseConfiguration->getChunkHandlerURL();
        $this->entryPicturePartsCount = $baseConfiguration->getEntryPicturePartsCount();
    }

    public function convert(): void
    {
        $this->setRawProperties();
        $this->determine();
    }

    private function determine(): void
    {
        if(isset($_GET['chunk_number']))
        {
            $this->outFragment((int) $_GET['chunk_number']);
        } else {
            $this->traverse();
        }
    }

    private function traverse(): void
    {
        $this->initCurlHandler();
        for($partNumber = 0; $partNumber < $this->entryPicturePartsCount; $partNumber++)
        {
            $this->prepareRequest($partNumber);
        }
        $this->request();
    }

    private function prepareRequest(int $partNumber): void
    {
        $url = $this->chunkHandlerURL."?chunk_number=".(string) $partNumber;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->curlHandlers[$url] = $ch;
        curl_multi_add_handle($this->curlHandler, $ch);
    }

    private function request(): void
    {
        do {
            $status = curl_multi_exec($this->curlHandler, $active);
        } while($active > 0);

        foreach($this->curlHandlers as $url => $curlHandler)
        {
            $data = curl_multi_getcontent($curlHandler);
            $data = explode(",", $data);
            foreach($data as $pixel){
                $this->contents[] = $pixel;
            }
            curl_multi_remove_handle($this->curlHandler, $curlHandler);
        }

        echo implode(",", $this->contents);

        curl_multi_close($this->curlHandler);
    }

    private function initCurlHandler(): void
    {
        $this->curlHandler = \curl_multi_init();
    }

    private function outFragment(int $partNumber): void
    {
        $this->pictureDivider->setChunkSelector($this->getChunkSelector($partNumber));
        $rasterDefiner = $this->getRasterDefiner($partNumber);
        $fragment = new Fragment($rasterDefiner, $this->pictureDivider);
        echo implode(",", $fragment->prepare()->getPixelVector());
    }

    private function getChunkSelector(int $partNumber): ChunkSelector
    {
        $chunkSelector = new ChunkSelector($this->xParts, $this->yParts);
        $chunkSelector = $chunkSelector->setSelectedPart($partNumber);
        return $chunkSelector;
    }

    private function getRasterDefiner(int $partNumber): RasterDefiner
    {
        $rasterDefiner = new RasterDefiner();
        $rasterDefiner = $this->setParamsFromBaseConfiguration($rasterDefiner);
        $rasterDefiner = $rasterDefiner->setPartNumber($partNumber);
        return $rasterDefiner;
    }

    private function setRawProperties(): void
    {
        $this->pictureDivider = new PictureDivider();
        $this->factorArray = $this->pictureDivider->factorize($this->entryPicturePartsCount);
        $this->xParts = $this->pictureDivider->getNumberOfHorizontalChunks($this->factorArray);
        $this->yParts = $this->pictureDivider->getNumberOfVerticalChunks($this->factorArray);
    }

    private function setParamsFromBaseConfiguration(RasterDefiner $rasterDefiner): RasterDefiner
    {
        $rasterDefiner = $rasterDefiner->setPath($this->fromPath);
        $rasterDefiner = $rasterDefiner->setEntryPicturePartsCount($this->entryPicturePartsCount);
        $rasterDefiner = $rasterDefiner->setChunkHandlerURL($this->chunkHandlerURL);
        return $rasterDefiner;
    }

}