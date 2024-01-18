<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Fragment;
use Arknet\IO\Trait\GDPictureHandlerName;
use Arknet\IO\Enumeration\PictureExtension;

trait RasterFile
{
	use PictureMeta;
	use PictureBag;
	use GDPictureHandlerName;

	private PixelEntity $pixelEntity;

	private function beforeCheckingPrepare(): void
	{
		$this->setExtension($this->getImageExtension());
	}

	private function isMatchingPicture(): bool
	{
		if($this->isValidPath()){
			return $this->isValidPropertyExtension();
		}
		return false;
	}

	private function isValidPath(): bool
	{
		return file_exists($this->path);
	}

	private function isValidPropertyExtension(): bool
	{
		if(PictureExtension::tryFrom($this->extension) === null){
			return false;
		}
		return true;
	}

	private function afterCheckingPrepare(): Fragment
	{
		$this->setRemainingRawDataInProperties();
		return $this;
	}

	private function getImageExtension(): string
	{
		setlocale(LC_ALL,'en_US.UTF-8');
		return pathinfo($this->path, PATHINFO_EXTENSION);
	}

	private function setRemainingRawDataInProperties(): void
	{
		$this->setGDImage($this->getPictureGDImage());
		$this->setWidth($this->getPictureWidth());
		$this->setHeight($this->getPictureHeight());
		$this->pictureDivider->setHeight($this->getHeight());
		$this->pictureDivider->setWidth($this->getWidth());
		$this->setVector($this->getPictureVector());
	}

	private function getPictureGDImage(): \GDImage
	{
		$handlerName = $this->getHandlerName($this->extension);
		return $handlerName($this->path);
	}

	private function getPictureWidth(): int
	{
		return imagesx($this->GDImage);
	}

	private function getPictureHeight(): int
	{
		return imagesy($this->GDImage);
	}

	private function getPictureVector(): array
	{
		$chunkSelector = $this->pictureDivider->getChunkSelector();
		$minimalHeight = $this->pictureDivider->getMinimalHeight($chunkSelector);
		$maximumHeight = $this->pictureDivider->getMaximumHeight($chunkSelector);
		for($y = $minimalHeight; $y < $maximumHeight; $y++){
			$picture[$y] = $this->getLineInRawPicture($y);
		}
		return $picture;
	}

	private function getLineInRawPicture(int $line): array
	{
		$chunkSelector = $this->pictureDivider->getChunkSelector();
		$minimalWidth = $this->pictureDivider->getMinimalWidth($chunkSelector);
		$maximumWidth = $this->pictureDivider->getMaximumWidth($chunkSelector);
		for($x = $minimalWidth; $x < $maximumWidth; $x++){
			$lines[$x] = $this->getPixelRaw($x, $line);
		}
		return $lines ?? [];
	}

	private function getPixelRaw(int $x, int $y): int|false
	{
		return imagecolorat($this->GDImage, $x, $y);
	}
}