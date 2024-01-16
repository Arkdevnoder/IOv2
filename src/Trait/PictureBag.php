<?php

namespace Arknet\IO\Trait;

trait PictureBag
{
	private \GdImage $GDImage;
	private array $vector;

	public function setGDImage(\GdImage $GDImage): object
	{
		$this->GDImage = $GDImage;
		return $this;
	}

	public function setVector(array $vector): object
	{
		$this->vector = $vector;
		return $this;
	}

	public function getGDImage(): \GDImage
	{
		return $this->GDImage;
	}

	public function getVector(): array
	{
		return $this->vector;
	}
}