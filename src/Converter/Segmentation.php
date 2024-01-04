<?php

namespace Arknet\IO\Converter;

use Arknet\IO\Picture;
use Arknet\IO\Formalizer\Converter;
use Arknet\IO\Trait\InAndOutPathProperty;
use Arknet\IO\Initializer\BaseConfiguration;

class Segmentation implements Converter {

	use InAndOutPathProperty;

	public function __construct(BaseConfiguration $baseConfiguration){
		$this->fromPath = $baseConfiguration->getFromPath();
		$this->toPath = $baseConfiguration->getToPath();
	}

	public function convert(): void
	{
		$picture = new Picture($this->fromPath);
		$n = microtime(true);
		var_dump(count($picture->prepare()->getPictureGrid()));
		echo microtime(true) - $n;
	}

}