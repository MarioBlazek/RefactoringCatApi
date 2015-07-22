<?php

include "CatApi.php";

class RealCatApi implements CatApi
{

	/**
	 * @var HttpClient
	 */
	private $httpClient;

	public function __construct(HttpClient $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	public function getRandomImage()
	{
		try {

			$responseXml = $this->httpClient->get('http://thecatapi.com/api/images/get?format=xml&type=jpg');

		} catch (HttpRequestFailed $exception) {
			return Url::fromString('http://cdn.my-cool-website.com/default.jpg');
		}

		$responseElement = new \SimpleXMLElement($responseXml);

		return Url::fromString((string)$responseElement->data->images[0]->image->url);
	}
}