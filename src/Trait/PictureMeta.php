<?php

namespace Arknet\IO\Trait;

trait PictureMeta
{
	use PictureSize;
	
	private string $extension;

	public function setExtension(string $extension): object
	{
		$this->extension = $extension;
		return $this;
	}

	public function getExtension(): string
	{
		return $this->extension;
	}
}