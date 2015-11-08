<?php
namespace Sotr\Crypto\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

class TestUtils
{
	public static function buildMockedClient(array &$container, array $responses)
	{
		$history = Middleware::history($container);
		$mock = new MockHandler($responses);
		$handler = HandlerStack::create($mock);
		$handler->push($history);
		return new Client(['handler' => $handler]);
	}
}
