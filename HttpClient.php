<?php

interface HttpClient
{
	/**
	 * @param string $url
	 *
	 * @return string|false Response body
	 */
	public function get($url);
}