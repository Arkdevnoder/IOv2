<?php

namespace Arknet\IO\Initializer;

use Arknet\IO\Trait\EntryFragmentProperty;
use Arknet\IO\Trait\ChunkFragmentGetterSetter;

class BaseConfiguration
{
	use EntryFragmentProperty;
	use ChunkFragmentGetterSetter;

	public function setFromPath(string $path): BaseConfiguration
	{
		$this->fromPath = $path;
		return $this;
	}

	public function getFromPath(): string
	{
		return $this->fromPath;
	}
}