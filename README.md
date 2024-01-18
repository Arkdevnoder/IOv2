PHP Image splitter

Example usage:

```


ini_set('memory_limit','2048M');

require "vendor/autoload.php";

$fromPath = '/path/to/picture';
$chunkHandlerURL = "http://path/to/url/handler";
$entryPicturePartsCount = 300;

$configuration = new Arknet\IO\Initializer\BaseConfiguration;
$configuration = $configuration->setFromPath($fromPath);
$configuration = $configuration->setEntryPicturePartsCount($entryPicturePartsCount);
$configuration = $configuration->setChunkHandlerURL($chunkHandlerURL);

$initializer = new Arknet\IO\ImageDivider($configuration);
$initializer->identify();

```