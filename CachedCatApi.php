<?php

include "CatApi.php";

class CachedCatApi implements CatApi
{
	private $realCatApi;

	public function __construct(CatApi $realCatApi)
	{
		$this->realCatApi = $realCatApi;
	}

	public function getRandomImage()
	{
		$cacheFilePath = __DIR__ . '/cache/random';
		if (!file_exists($cacheFilePath)
			|| time() - filemtime($cacheFilePath) > 3) {

			// not in cache, so do the real thing
			$url = $this->realCatApi->getRandomImage();

			file_put_contents($cacheFilePath, $url);

			return $url;
		}

		return file_get_contents($cacheFilePath);
	}
}