<?php

interface Cache
{
	public function isNotFresh($lifetime);

	public function put($url);

	public function get();
}