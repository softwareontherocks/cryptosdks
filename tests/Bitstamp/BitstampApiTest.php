<?php
namespace Sotr\Crypto\Tests\Bitstamp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_TestCase;

use Sotr\Crypto\Bitstamp\BitstampApi;
use Sotr\Crypto\Ticker;

class BitstampApiTest extends PHPUnit_Framework_TestCase
{
	public function testGetTicker()
	{
		$container = [];
		$history = Middleware::history($container);

		$mock = new MockHandler([
		    new Response(200, ['Content-Type' => 'application/json'], json_encode(['high' => 200, 'last' => 115.61, 'timestamp' => 1446974253, 'bid' => 114.05, 'vwap' => 384.86, 'volume' => 23343.37, 'low' => 100, 'ask' => 116.21, 'open' => 383.62])),
		]);

		$handler = HandlerStack::create($mock);
		$handler->push($history);
		$client = new Client(['handler' => $handler]);

		$api = new BitstampApi($client);

		$ticker = $api->getTicker();
		$expectedTicker = new Ticker(115.61, 200, 100, 114.05, 116.21);

		$this->assertCount(1, $container);
		$this->assertEquals('GET', $container[0]['request']->getMethod());
		$this->assertEquals('https://www.bitstamp.net/api/ticker', $container[0]['request']->getUri());

		$this->assertEquals($expectedTicker, $ticker);
	}
}
