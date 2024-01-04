<?php

namespace Arknet\IO\Converter;

use Arknet\IO\Initializer\BaseConfiguration;

class Segmentation {

	public function __construct(BaseConfiguration $baseConfiguration){
		$this->fromPath = $baseConfiguration->fromPath;
		$this->toPath = $baseConfiguration->toPath;
	}

	public function convert(){
		echo $this->fromPath;
		echo PHP_EOL;
		echo $this->toPath;
	}

}