<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Preparable;
use Arknet\IO\Trait\RasterFile;
use Arknet\IO\Initializer\RasterDefiner;

class Picture implements Preparable
{
	use RasterFile;

	private string $path;
	private float $scale;
	private int $chunksCount;

	public function __construct(
		private RasterInitializer $rasterInitializer
	) {
		$this->path = $rasterInitializer->getPath();
		$this->scale = $rasterInitializer->getScale();
		$this->chunksCount = $rasterInitializer->getChunksCount();
	}

	public function prepare(): Picture
	{
		$this->beforeCheckingPrepare();
		if(!$this->isMatchingPicture()){
			throw new Extension("Picture malformed");
		}
		return $this->afterCheckingPrepare();
	}

	public function getVector(): array
	{
		return $this->vector;
	}

	public function countVector(): int
	{
		return count($this->vector);
	}
}