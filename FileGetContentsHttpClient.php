<?php

class FileGetContentsHttpClient
{
	public function get($url)
	{
		return @file_get_contents($url);
	}
}