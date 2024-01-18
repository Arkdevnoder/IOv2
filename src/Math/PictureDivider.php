<?php

namespace Arknet\IO\Math;

use Arknet\IO\Trait\PictureSize;
use Arknet\IO\Trait\ChunkProperty;
use Arknet\IO\Trait\ChunkPartGetterSetter;
use Arknet\IO\Initializer\ChunkSelector;

class PictureDivider
{
    use PictureSize;
    use ChunkProperty;
    use ChunkPartGetterSetter;

    private int $matchedDividerNumber;
    private int $partsCount;
    private array $resultArray;
    private ChunkSelector $chunkSelector;

    public function setChunkSelector(ChunkSelector $chunkSelector): void
    {
        $this->chunkSelector = $chunkSelector;
    }

    public function getChunkSelector(): ChunkSelector
    {
        return $this->chunkSelector;
    }

    public function getMinimalWidth(ChunkSelector $chunkSelector): int
    {
        $partsX = $chunkSelector->getNumberOfHorizontalChunks();
        $widthPart = $this->getWidth()/$partsX;
        return intval($widthPart*($chunkSelector->getX()));
    }

    public function getMinimalHeight(ChunkSelector $chunkSelector): int
    {
        $partsY = $chunkSelector->getNumberOfVerticalChunks();
        $heightPart = $this->getHeight()/$partsY;
        return intval($heightPart*($chunkSelector->getY()));
    }

    public function getMaximumWidth(ChunkSelector $chunkSelector): int
    {
        $partsX = $chunkSelector->getNumberOfHorizontalChunks();
        $widthPart = $this->getWidth()/$partsX;
        return intval($widthPart*($chunkSelector->getX()+1));
    }

    public function getMaximumHeight(ChunkSelector $chunkSelector): int
    {
        $partsY = $chunkSelector->getNumberOfVerticalChunks();
        $heightPart = $this->getHeight()/$partsY;
        return intval($heightPart*($chunkSelector->getY()+1));
    }

    public function getNumberOfVerticalChunks(array $factorArray): int
    {
        foreach($factorArray as $key => $element)
        {
            if($this->isNotEqualRange($key, $factorArray))
            {
                return array_product($this->getNextElementsOfArrayByKey($key, $factorArray));
            }
        }
    }

    public function getNumberOfHorizontalChunks(array $factorArray): int
    {
        foreach($factorArray as $key => $element)
        {
            if($this->isNotEqualRange($key, $factorArray))
            {
                return array_product(array_merge($this->getPreviousElementsOfArrayByKey($key, $factorArray), [$element]));
            }
        }
    }

    public function factorize(int $partsCount): array
    {
        $this->partsCount = $partsCount;
        do {
            $this->resultArray = $this->computeResultArray();
        } while(!$this->isPrimeNumber($this->partsCount));
        return $this->resultArray;
    }

    private function isNotEqualRange(int $key, array $factorArray): bool
    {
        if($this->getRangeCompareExpression($key, $factorArray))
        {
            return true;
        }
        return false;
    }

    private function getRangeCompareExpression(int $key, array $factorArray): bool
    {
        $range1 = $this->getPreviousElementsOfArrayByKey($key, $factorArray) + [$factorArray[$key]];
        $range2 = $this->getNextElementsOfArrayByKey($key, $factorArray);
        return array_product($range1) >= array_product($range2);
    }

    private function getPreviousElementsOfArrayByKey(int $key, array $elements): array
    {
        for($i = $key-1; $i >= 0; $i--)
        {
            $resultArray[] = $elements[$i];
        }
        return $resultArray ?? [];
    }

    private function getNextElementsOfArrayByKey(int $key, array $elements): array
    {
        for($i = $key + 1; $i < count($elements); $i++)
        {
            $resultArray[] = $elements[$i];
        }
        return $resultArray ?? [];
    }

    private function computeResultArray()
    {
        $this->matchedDividerNumber = $this->getMinimumDivided($this->partsCount);
        $this->partsCount = $this->divide($this->partsCount, $this->matchedDividerNumber);
        $result = $this->push($this->matchedDividerNumber, $this->resultArray ?? []);
        return $this->pushIfPrime($this->partsCount, $result);
    }

    private function pushIfPrime(int $primeNumber, array $resultArray): array
    {
        if($this->isPrimeNumber($primeNumber))
        {
            return $this->push($primeNumber, $resultArray);
        }
        return $resultArray;
    }

    private function push(int $element, array $list): array
    {
        $list[] = $element;
        return $list;
    }

    private function divide(int $number1, int $number2): int
    {
        return (int) $number1/$number2;
    }

    private function getMinimumDivided(int $partsCount): int
    {
        for($i = 2; $i <= $partsCount; $i++)
        {
            if($this->isCompletelyDivided($partsCount, $i))
            {
                return $i;
            }
        }
        return 0;
    }

    private function isPrimeNumber(int $number): bool
    {
        for($i = 2; $i < $number; $i++)
        {
            if($this->isCompletelyDivided($number, $i))
            {
                return false;
            }
        }
        return true;
    }

    private function isCompletelyDivided(int $number1, int $number2): bool
    {
        if($number1 % $number2 === 0)
        {
            return true;
        }
        return false;
    }

}