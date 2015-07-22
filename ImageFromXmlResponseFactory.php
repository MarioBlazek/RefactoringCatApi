<?php

class ImageFromXmlResponseFactory
{
	public function fromResponse($response)
	{
		$responseElement = new \SimpleXMLElement($response);

		$url = (string) $responseElement->data->images[0]->image->url;

		return new Image($url);
	}
}