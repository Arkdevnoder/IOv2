<?php

namespace Arknet\IO\Initializer;

use Arknet\IO\Trait\InAndOutPathProperty;

class BaseConfiguration {

	use InAndOutPathProperty;

	public function setFromPath(string $path): BaseConfiguration
	{
		$this->fromPath = $path;
		return $this;
	}

	public function setToPath(string $path): BaseConfiguration
	{
		$this->toPath = $path;
		return $this;
	}

	public function getFromPath(): string
	{
		return $this->fromPath;
	}

	public function getToPath(): string
	{
		return $this->toPath;
	}

}