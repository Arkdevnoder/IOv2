<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Preparable;

class Pixel implements Preparable {

	private int $red;
	private int $green;
	private int $blue;

	public function __construct(
		private $rgb
	) {}

	public function getRed(): int
	{
		return $this->red;
	}

	public function getGreen(): int
	{
		return $this->green;
	}

	public function getBlue(): int
	{
		return $this->blue;
	}

	public function prepare()
	{
		$this->red = ($this->rgb >> 16) & 0xFF;
		$this->green = ($this->rgb >> 8) & 0xFF;
		$this->blue = $this->rgb & 0xFF;
	}
}