<?php

namespace Arknet\IO\Initializer;

class RasterDefiner
{
	private float $scale;
	private int $chunksCount;
	private string $path;

	public function setScale(float $scale): RasterDefiner
	{
		$this->scale = $scale;
		return $this;
	}

	public function setChunksCount(int $chunksCount): RasterDefiner
	{
		$this->chunksCount = $chunksCount;
		return $this;
	}

	public function setPath(string $path): RasterDefiner
	{
		$this->path = $path;
		return $this;
	}

	public function getScale(): float
	{
		return $this->scale;
	}

	public function getChunksCount(): int
	{
		return $this->chunksCount;
	}

	public function getPath(): string
	{
		return $this->path;
	}
}