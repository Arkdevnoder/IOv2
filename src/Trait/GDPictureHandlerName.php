<?php

namespace Arknet\IO\Trait;

use Arknet\IO\Enumeration\PictureExtension;

trait GDPictureHandlerName {

	public function getHandlerName(string $extension): string
	{
		return match($extension){
			PictureExtension::Png->value => "imagecreatefrompng",
			PictureExtension::Jpg->value => "imagecreatefromjpeg",
			PictureExtension::Jpeg->value => "imagecreatefromjpeg"
		};
	}
}