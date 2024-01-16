<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Preparable;

abstract class PixelPrototype implements Preparable
{
	protected int $red;
	protected int $green;
	protected int $blue;
	protected int $rgb;

	abstract public function __clone();

	public function setColor(int $rgb): void
	{
		$this->rgb = $rgb;
	}

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

	public function prepare(): void
	{
		$this->red = ($this->rgb >> 16) & 0xFF;
		$this->green = ($this->rgb >> 8) & 0xFF;
		$this->blue = $this->rgb & 0xFF;
	}
}