<?php

interface HttpClient
{
	/**
	 * @param string $url
	 *
	 * @return string|false Response body
	 * @throws HttpRequestFailed
	 */
	public function get($url);
}