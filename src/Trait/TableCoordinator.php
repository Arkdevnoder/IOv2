<?php

namespace Arknet\IO\Trait;

trait TableCoordinator
{
	public function getX(): int
	{
		return intval($this->selectedPart % $this->getNumberOfHorizontalChunks());
	}

	public function getY(): int
	{
		return intval($this->selectedPart / $this->getNumberOfHorizontalChunks());
	}
}