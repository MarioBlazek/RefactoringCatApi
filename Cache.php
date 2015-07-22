<?php

interface Cache
{
	public function isNotFresh($lifetime);

	public function put(Url $url);

	public function get();
}