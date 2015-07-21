<?php

include "RealCatApi.php";

class RealCatApiTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_fetches_a_random_url_of_a_cat_gif()
	{
		$xmlResponse = <<<EOD
<response>
    <data>
        <images>
            <image>
                <url>http://24.media.tumblr.com/tumblr_lgg3m9tRY41qgnva2o1_500.jpg</url>
                <id>bie</id>
                <source_url>http://thecatapi.com/?id=bie</source_url>
            </image>
        </images>
    </data>
</response>
EOD;
		$httpClient = $this->getMock('HttpClient');
		$httpClient
			->expect($this->once())
			->method('get')
			->with('http://thecatapi.com/api/images/get?format=xml&type=jpg')
			->will($this->returnValue($xmlResponse));
		$catApi = new RealCatApi($httpClient);

		$url = $catApi->getRandomImage();

		$this->assertSame(
			'http://24.media.tumblr.com/tumblr_lgg3m9tRY41qgnva2o1_500.jpg',
			$url
		);
	}

	/** @test */
	public function it_returns_a_default_url_when_the_http_request_fails()
	{
		$httpClient = $this->getMock('HttpClient');
		$httpClient
			->expect($this->once())
			->method('get')
			->with('http://thecatapi.com/api/images/get?format=xml&type=jpg')
			->will($this->throwException(new HttpRequestFailed());
		$catApi = new RealCatApi($httpClient);

		$url = $catApi->getRandomImage();

		$this->assertSame(
			'http://cdn.my-cool-website.com/default.jpg',
			$url
		);
	}
}