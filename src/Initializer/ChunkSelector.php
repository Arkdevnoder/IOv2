<?php

namespace Arknet\IO\Initializer;

use Arknet\IO\Trait\TableCoordinator;

class ChunkSelector
{
	use TableCoordinator;

	private $selectedPart;
	private $numberOfHorizontalChunks;
	private $numberOfVerticalChunks;

	public function __construct(int $numberOfHorizontalChunks, int $numberOfVerticalChunks)
	{
		$this->numberOfHorizontalChunks = $numberOfHorizontalChunks;
		$this->numberOfVerticalChunks = $numberOfVerticalChunks;
	}

	public function getNumberOfVerticalChunks(): int
	{
		return $this->numberOfVerticalChunks;
	}

	public function getNumberOfHorizontalChunks(): int
	{
		return $this->numberOfHorizontalChunks;
	}

	public function setSelectedPart(int $selectedPart): object
	{
		$this->selectedPart = $selectedPart;
		return $this;
	}

	public function getSelectedPart(): int
	{
		return $this->selectedPart;
	}
}