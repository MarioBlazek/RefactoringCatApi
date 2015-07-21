<?php

class FileGetContentsHttpClient implements HttpClient
{
	public function get($url)
	{
		$response = @file_get_contents($url);
		if ($response === false) {
			throw new HttpRequestFailed();
		}

		return $response;
	}
}