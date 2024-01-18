<?php

namespace Arknet\IO;

use Arknet\IO\Formalizer\Detector;
use Arknet\IO\Initializer\BaseConfiguration;
use Arknet\IO\Converter\Splitter;

class ImageDivider implements Detector
{
	private BaseConfiguration $baseConfiguration;

	public function __construct(BaseConfiguration $baseConfiguration)
	{
		$this->baseConfiguration = $baseConfiguration;
	}

	public function identify(): void
	{
		$this->getSplitter()->convert();
	}

	private function getSplitter(): Splitter
	{
		return new Splitter($this->baseConfiguration);
	}
}