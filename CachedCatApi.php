<?php

include "CatApi.php";

class CachedCatApi implements CatApi
{
	/**
	 * @var CatApi
	 */
	private $realCatApi;

	/**
	 * @var Cache
	 */
	private $cache;

	public function __construct(CatApi $realCatApi, Cache $cache)
	{
		$this->realCatApi = $realCatApi;
		$this->cache = $cache;
	}

	public function getRandomImage()
	{
		if ( $this->cache->isNotFresh(3) ) {
			// not in cache, so do the real thing
			$url = $this->realCatApi->getRandomImage();

			$this->cache->put($url);

			return $url;
		}

		return $this->cache->get();
	}
}