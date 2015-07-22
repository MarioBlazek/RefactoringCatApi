<?php

class FileCache implements Cache
{
	private $cacheFilePath;

	public function __construct()
	{
		$this->cacheFilePath = __DIR__ . '/cache/random';
	}

	public function isNotFresh($lifetime)
	{
		return !file_exists($this->cacheFilePath)
		|| time() - filemtime($this->cacheFilePath) > $lifetime;
    }

	public function put(Url $url)
	{
		file_put_contents($this->cacheFilePath, (string) $url);
	}

	public function get()
	{
		return Url::fromString(file_get_contents($this->cacheFilePath));
	}
}