<?php

namespace Arknet\IO\Initializer;

class BaseConfiguration {

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

}