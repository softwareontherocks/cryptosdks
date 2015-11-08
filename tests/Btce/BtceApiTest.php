<?php
namespace Sotr\Crypto\Tests\Btce;

use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_TestCase;

use Sotr\Crypto\Btce\BtceApi;
use Sotr\Crypto\Tests\TestUtils;
use Sotr\Crypto\Ticker;

class BtceApiTest extends PHPUnit_Framework_TestCase
{
	public function testGetTicker()
	{
		$container = [];
		$client = TestUtils::buildMockedClient(
			$container,
			[new Response(200, [], json_encode(['ticker' => ['high' => 100, 'low' => 5, 'avg' => 86.42, 'vol' => 156000, 'vol_cur' => 145000, 'last' => 91.3, 'buy' => 91.32, 'sell' => 90.88, 'updated' => 1446920706, 'server_time' => 1446920706]]))]
		);
		$api = new BtceApi();
		$api->setClient($client);

		$ticker = $api->getTicker();
		$expectedTicker = new Ticker(91.3, 100, 5, 90.88, 91.32);

		$this->assertCount(1, $container);
		$this->assertEquals('GET', $container[0]['request']->getMethod());
		$this->assertEquals('https://btc-e.com/api/2/btc_usd/ticker', $container[0]['request']->getUri());

		$this->assertEquals($expectedTicker, $ticker);
	}
}
