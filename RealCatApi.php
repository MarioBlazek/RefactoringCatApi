<?php

include "CatApi.php";

class RealCatApi implements CatApi
{

	/**
	 * @var HttpClient
	 */
	private $httpClient;

	/**
	 * @var ImageFromXmlResponseFactory
	 */
	private $imageFactory;

	public function __construct(HttpClient $httpClient, ImageFromXmlResponseFactory $imageFactory)
	{
		$this->httpClient = $httpClient;
		$this->imageFactory = $imageFactory;
	}

	public function getRandomImage()
	{
		try {

			$responseXml = $this->httpClient->get('http://thecatapi.com/api/images/get?format=xml&type=jpg');

		} catch (HttpRequestFailed $exception) {
			return Url::fromString('http://cdn.my-cool-website.com/default.jpg');
		}

		$image = $this->imageFactory->fromResponse($responseXml);

		$url = $image->url();

		return Url::fromString($url);
	}
}