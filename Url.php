<?php

class Url
{
	private $url;

	public function __construct($url)
	{
		self::check($url);

		$this->url = $url;
	}

	public static function fromString($url)
	{
		self::check($url);

		return new self($url);
	}

	public function __toString()
	{
		return $this->url;
	}

	private static function check($url)
	{
		if (!is_string($url)) {
			throw new \InvalidArgumentException('URL was expected to be a string');
		}

		if (filter_var($url, FILTER_VALIDATE_URL) === false) {
			throw new \RuntimeException('The provided URL is invalid');
		}
	}
}