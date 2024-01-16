<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Initializer\RasterDefiner;
use Arknet\IO\Initializer\BaseConfiguration;

trait ChunkFragmentGetterSetter {

	use ChunkPartGetterSetter;

	public function getChunkHandlerURL(): string
	{
		return $this->chunkHandlerURL;
	}

	public function getEntryPicturePartsCount(): int
	{
		return $this->entryPicturePartsCount;
	}
}