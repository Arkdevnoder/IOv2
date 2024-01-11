<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Enumeration\SettingParameter;

trait RasterCaller {

	use DefaultSetting;

	private RasterInitializer $rasterInitializer;

	private function getRasterInitializer(): RasterInitializer
	{
		$this->rasterInitializer = new RasterInitializer();
		$this->setDefalutSettings($rasterInitializer);
		return $this->rasterInitializer;
	}

	private function setDefaultSettings(RasterInitializer $rasterInitializer): void {
		$this->setDefaultScale();
		$this->setDefaultChunksCount();
		$this->setPath();
	}

	private function setDefaultScale(): void
	{
		$pictureScaleParameterName = $this->getPictureScaleParameterName();
		$this->rasterInitializer->setScale($this->getFloatParameter($pictureScaleParameterName));
	}

	private function setDefaultChunksCount(): void
	{
		$pictureChunksCountParameterName = $this->getPictureChunksCountParameterName();
		$valueOfChunksCount = $this->getIntegerParameter($pictureChunksCountParameterName);
		$this->rasterInitializer->setChunksCount();
	}

	private function getPictureScaleParameterName(): string
	{
		return SettingParameter::EntryPictureScale->value;
	}

	private function getPictureChunksCountParameterName(): string
	{
		return SettingParameter::CountOfPictureChunks->value;
	}
}