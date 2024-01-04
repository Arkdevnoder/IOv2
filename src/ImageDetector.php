<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Detector;
use Arknet\IO\Initializer\BaseConfiguration;
use Arknet\IO\Converter\Segmentation;

class ImageDetector implements Detector {

	private BaseConfiguration $baseConfiguration;

	public function __construct(BaseConfiguration $baseConfiguration)
	{
		$this->baseConfiguration = $baseConfiguration;
	}

	public function identify(): void
	{
		$this->getSegmentation()->convert();
	}

	private function getSegmentation(): Segmentation
	{
		return new Segmentation($this->baseConfiguration);
	}

}