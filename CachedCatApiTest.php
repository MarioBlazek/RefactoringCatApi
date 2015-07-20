<?php

class CachedCatApiTest extends \PHPUnit_Framework_TestCase
{
	protected function tearDown()
	{
		@unlink(__DIR__ . '/cache/random');
	}

	/** @test */
	public function it_caches_a_random_cat_gif_url_for_3_seconds()
	{
		$realCatApi = $this->getMock('RealCatApi');
		$realCatApi
			->expects($this->any())
			->will($this->returnValue(
			// the real API returns a random URl every time
				'http://cat-api/random-image/' . uniqid()
			));

		$cachedCatApi = new CachedCatApi($realCatApi);

		$firstUrl = $cachedCatApi->getRandomImage();
		sleep(2);
		$secondUrl = $cachedCatApi->getRandomImage();
		sleep(2);
		$thirdUrl = $cachedCatApi->getRandomImage();

		$this->assertSame($firstUrl, $secondUrl);
		$this->assertNotSame($secondUrl, $thirdUrl);
	}
}