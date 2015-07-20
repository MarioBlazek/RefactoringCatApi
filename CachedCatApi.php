<?php

class CachedCatApi
{
	public function getRandomImage()
	{
		$cacheFilePath = __DIR__ . '/cache/random';
		if (!file_exists($cacheFilePath)
			|| time() - filemtime($cacheFilePath) > 3) {

			// not in cache, so do the real thing
			$realCatApi = new CatApi();
			$url = $realCatApi->getRandomImage();

			file_put_contents($cacheFilePath, $url);

			return $url;
		}

		return file_get_contents($cacheFilePath);
	}
}