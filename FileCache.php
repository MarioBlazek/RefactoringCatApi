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

	public function put($url)
	{
		file_put_contents($this->cacheFilePath, $url);
	}

	public function get()
	{
		return file_get_contents($this->cacheFilePath);
	}
}