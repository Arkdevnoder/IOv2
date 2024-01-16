<?php

namespace Arknet\IO\Trait;

trait ChunkPartGetterSetter {

	public function getEntryPicturePartsCount(): int
	{
		return $this->entryPicturePartsCount;
	}

	public function setEntryPicturePartsCount(int $partsCount): object
	{
		$this->entryPicturePartsCount = $partsCount;
		return $this;
	}

	public function setPartNumber(int $part): object
	{
		$this->partNumber = $part;
		return $this;
	}

	public function getPartNumber(): int
	{
		return $this->partNumber;
	}
}