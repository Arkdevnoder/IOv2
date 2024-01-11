<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Picture;
use Arknet\IO\Trait\GDPictureHandlerName;
use Arknet\IO\Enumeration\PictureExtension;

trait RasterFile
{
	use GDPictureHandlerName;

	private int $width;
	private int $height;
	private string $extension;
	private \GdImage $GDImage;
	private array $vector;
	private PixelEntity $pixelEntity;

	private function beforeCheckingPrepare(): void
	{
		$this->extension = $this->getImageExtension();
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

	private function afterCheckingPrepare(): Picture
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
		$this->GDImage = $this->getGDImage();
		$this->width = $this->getPictureWidth();
		$this->height = $this->getPictureHeight();
		$this->vector = $this->getPictureVector();
	}

	private function getGDImage(): \GDImage
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
		for($y = 0; $y < $this->height; $y++){
			$picture[$y] = $this->getLineInRawPicture($y);
		}
		return $picture;
	}

	private function getLineInRawPicture(int $line): array
	{
		for($x = 0; $x < $this->width; $x++){
			$lines[$x] = $this->getPixelRaw($x, $line);
		}
		return $lines;
	}

	private function getPixelRaw($x, $y): int|false
	{
		return imagecolorat($this->GDImage, $x, $y);
	}
}