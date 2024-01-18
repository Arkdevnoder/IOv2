<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Preparable;
use Arknet\IO\Trait\RasterFile;
use Arknet\IO\Math\PictureDivider;
use Arknet\IO\Initializer\RasterDefiner;

class Fragment implements Preparable
{
	use RasterFile;

	private string $path;
	private float $scale;
	private int $entryPicturePartsCount;

	public function __construct(
		private RasterDefiner $rasterInitializer,
		private PictureDivider $pictureDivider
	) {
		$this->path = $rasterInitializer->getPath();
		$this->scale = $rasterInitializer->getScale();
		$this->entryPicturePartsCount = $rasterInitializer->getEntryPicturePartsCount();
	}

	public function prepare(): Fragment
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

	public function getPixelVector(): array
	{
		foreach($this->vector as $line)
		{
			$result = $this->addPixelLine($line, $result ?? []);
		}
		return $result;
	}

	public function countVector(): int
	{
		return count($this->vector);
	}

	private function addPixelLine(array $line, array $result): array
	{
		foreach($line as $pixel)
		{
			$result[] = $pixel;
		}
		return $result;
	}
}