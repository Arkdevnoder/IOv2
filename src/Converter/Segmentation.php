<?php

namespace Arknet\IO\Converter;

use Arknet\IO\Picture;
use Arknet\IO\Formalizer\Converter;
use Arknet\IO\Trait\RasterCaller;
use Arknet\IO\Trait\DefaultSetting;
use Arknet\IO\Trait\InAndOutPathProperty;
use Arknet\IO\Initializer\RasterDefiner;
use Arknet\IO\Initializer\BaseConfiguration;

class Segmentation implements Converter
{
	use RasterCaller;
	use InAndOutPathProperty;

	public function __construct(BaseConfiguration $baseConfiguration)
	{
		$this->fromPath = $baseConfiguration->getFromPath();
		$this->toPath = $baseConfiguration->getToPath();
	}

	public function convert(): void
	{
		$rasterInitializer = $this->getRasterCaller();
		$picture = new Picture($rasterInitializer);

		$n = microtime(true);
		var_dump($picture->prepare()->countVector());
		echo microtime(true) - $n;
	}

	private function getRasterCaller(): RasterInitializer
	{
		return $this->getRasterInitializer();
	}
}