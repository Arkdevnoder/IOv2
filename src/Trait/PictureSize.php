<?php

namespace Arknet\IO\Trait;

trait PictureSize
{
	private int $width;
	private int $height;

	public function setWidth(int $width): object
	{
		$this->width = $width;
		return $this;
	}

	public function setHeight(int $height): object
	{
		$this->height = $height;
		return $this;
	}

	public function getWidth(): int
	{
		return $this->width;
	}

	public function getHeight(): int
	{
		return $this->height;
	}
}