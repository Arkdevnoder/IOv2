<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Initializer\RasterDefiner;
use Arknet\IO\Initializer\BaseConfiguration;

trait ChunkFragmentGetterSetter {

	use ChunkPartGetterSetter;

	public function setChunkHandlerURL(string $chunkHandlerURL): object
	{
		$this->chunkHandlerURL = $chunkHandlerURL;
		return $this;
	}

	public function setEntryPicturePartsCount(string $entryPicturePartsCount): object
	{
		$this->entryPicturePartsCount = $entryPicturePartsCount;
		return $this;
	}

	public function getChunkHandlerURL(): string
	{
		return $this->chunkHandlerURL;
	}

	public function getEntryPicturePartsCount(): int
	{
		return $this->entryPicturePartsCount;
	}
}