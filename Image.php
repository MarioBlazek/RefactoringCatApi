<?php

class Image
{
	private $url;

	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function url()
	{
		return $this->url;
	}
}