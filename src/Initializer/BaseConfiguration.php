<?php

namespace Arknet\IO\Initializer;

class BaseConfiguration {

	private string $fromPath;
	private string $toPath;

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