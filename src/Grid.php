<?php

namespace Arknet\IO;

class Grid implements Preparable
{
	private Picture $picture;
	private PixelEntity $pixelEntity;
	private array $vector;

	public function __construct(
		private Picture $picture
	) {
	}
	public function prepare()
	{
		$this->pixelEntity = $this->getPixelEntity();
		$this->vector = $this->getVector();
	}
	private function getVector(): array
	{
		$pictureVector = $this->picture->getVector();
		$countOfPictureVector = $this->picture->countVector();
		for($i = 0; $i < $countOfPictureVector; $i++){
			$this->vector[$i] = $this->getPixelEntity($pixelVector[$i]);
		}
	}
	private function getPixelEntity(): PixelEntity
	{
		return new PixelEntity();
	}
	private function getPixelHandler(int $rgb): PixelEntity
	{
		$pixel = clone $this->pixelEntity;
		$pixel->setColor($rgb);
		$pixel->prepare();
		return $pixel;
	}
}