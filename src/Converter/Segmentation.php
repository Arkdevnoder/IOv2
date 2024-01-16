<?php

namespace Arknet\IO\Converter;

use Arknet\IO\Fragment;
use Arknet\IO\Formalizer\Converter;
use Arknet\IO\Trait\DefaultSetting;
use Arknet\IO\Trait\EntryFragmentProperty;
use Arknet\IO\Initializer\RasterDefiner;
use Arknet\IO\Initializer\BaseConfiguration;

class Segmentation implements Converter
{
	use EntryFragmentProperty;

	public function __construct(BaseConfiguration $baseConfiguration)
	{
		$this->fromPath = $baseConfiguration->getFromPath();
		$this->toPath = $baseConfiguration->getToPath();
		$this->chunkHandlerURL = $baseConfiguration->getChunkHandlerURL();
		$this->entryPicturePartsCount = $baseConfiguration->getEntryPicturePartsCount();
	}

	public function convert(): void
	{
		for($partNumber = 0; $partNumber < $this->entryPicturePartsCount; $partNumber++)
		{
			$rasterDefiner = $this->getRasterDefiner();
			$rasterDefiner = $this->setParamsFromBaseConfiguration($rasterDefiner);
			$rasterDefiner = $rasterDefiner->setPartNumber($partNumber);
			$picture = new Fragment($rasterDefiner);
			$n = microtime(true);
			var_dump($picture->prepare()->countVector());
			echo microtime(true) - $n;
		}
	}

	private function setParamsFromBaseConfiguration(RasterDefiner $rasterDefiner): RasterDefiner
	{
		$rasterDefiner = $rasterDefiner->setPath($this->fromPath);
		$rasterDefiner = $rasterDefiner->setEntryPicturePartsCount($this->entryPicturePartsCount);
		$rasterDefiner = $rasterDefiner->setChunkHandlerURL($this->chunkHandlerURL);
		return $rasterDefiner;
	}

	private function getRasterDefiner(): RasterDefiner
	{
		return new RasterDefiner;
	}
}