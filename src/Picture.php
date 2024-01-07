<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Preparable;
use Arknet\IO\Trait\GDPictureHandlerName;
use Arknet\IO\Enumeration\PictureExtension;

class Picture implements Preparable {

	use GDPictureHandlerName;

	private int $width;
	private int $height;
	private string $extension;
	private \GdImage $GDImage;
	private array $gridPicture;
	private PixelEntity $pixelEntity;

	public function __construct(
		private string $path
	) {}

	public function prepare(): Picture
	{
		$this->beforeCheckingPrepare();
		if(!$this->isMatchingPicture()){
			throw new Extension("Picture malformed");
		}
		return $this->afterCheckingPrepare();
	}

	public function getPictureGrid(): array
	{
		return $this->gridPicture;
	}

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

	private function setRemainingRawDataInProperties(): void
	{
		$this->GDImage = $this->getGDImage();
		$this->width = $this->getPictureWidth();
		$this->height = $this->getPictureHeight();
		$this->pixelEntity = $this->getPixelEntity();
		$this->gridPicture = $this->getGridPicture();
	}

	private function getImageExtension(): string
	{
		setlocale(LC_ALL,'en_US.UTF-8');
		return pathinfo($this->path, PATHINFO_EXTENSION);
	}

	private function getPictureWidth(): int
	{
		return imagesx($this->GDImage);
	}

	private function getPictureHeight(): int
	{
		return imagesy($this->GDImage);
	}

	private function getGDImage(): \GDImage
	{
		$handlerName = $this->getHandlerName($this->extension);
		return $handlerName($this->path);
	}

	private function getPixelEntity(): PixelEntity
	{
		return new PixelEntity();
	}

	private function getGridPicture(): array
	{
		for($y = 0; $y < $this->height; $y++){
			$picture[$y] = $this->getLineInRawPicture($y);
		}
		return $picture;
	}

	private function getLineInRawPicture(int $line): array
	{
		for($x = 0; $x < $this->width; $x++){
			$rgb = $this->getPixelRaw($x, $line);
			$lines[$x] = $this->getPixelHandler($rgb);
		}
		return $lines;
	}

	private function getPixelHandler(int $rgb): PixelEntity
	{
		$pixel = clone $this->pixelEntity;
		$pixel->setColor($rgb);
		$pixel->prepare();
		return $pixel;
	}

	private function getPixelRaw($x, $y): int|false
	{
		return imagecolorat($this->GDImage, $x, $y);
	}

}