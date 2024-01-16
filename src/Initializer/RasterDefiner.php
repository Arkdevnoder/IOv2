<?php

namespace Arknet\IO\Initializer;

use Arknet\IO\Trait\DefaultSetting;
use Arknet\IO\Trait\EntryFragmentProperty;
use Arknet\IO\Trait\ChunkFragmentGetterSetter;
use Arknet\IO\Enumeration\SettingParameter;

class RasterDefiner
{
	use DefaultSetting;
	use EntryFragmentProperty;
	use ChunkFragmentGetterSetter;

	private float $scale;
	private string $path;

	public function __construct()
	{
		$this->setScale($this->getDefaultScale());
	}

	public function setScale(float $scale): RasterDefiner
	{
		$this->scale = $scale;
		return $this;
	}

	public function setPath(string $path): RasterDefiner
	{
		$this->path = $path;
		return $this;
	}

	public function getScale(): float
	{
		return $this->scale;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	private function getDefaultScale(): float
	{
		return $this->getFloatParameter($this->getScaleParameterName());
	}

	private function getScaleParameterName(): string
	{
		return SettingParameter::EntryPictureScale->value;
	}
}