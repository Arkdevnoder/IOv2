<?php

namespace Arknet\IO\Trait;

trait EntryFragmentProperty {

	use ChunkProperty;

	private string $fromPath;
	private string $toPath;
	private string $chunkHandlerURL;
}