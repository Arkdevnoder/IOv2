<?php

namespace Arknet\IO\Converter;

use Arknet\IO\Initializer\BaseConfiguration;

class Segmentation {

	private string $fromPath;
	private string $toPath;

	public function __construct(BaseConfiguration $baseConfiguration){
		$this->fromPath = $baseConfiguration->getFromPath();
		$this->toPath = $baseConfiguration->getToPath();
	}

	public function convert(){
		echo $this->fromPath;
		echo PHP_EOL;
		echo $this->toPath;
	}

}