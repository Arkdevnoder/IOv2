<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Enumeration\SettingParameter;

trait DefaultSetting {

	public function getFloatParameter(string $query): float
	{
		return match($query){
			SettingParameter::EntryPictureScale->value => 0.5
		};
	}
	
}