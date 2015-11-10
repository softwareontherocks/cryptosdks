<?php
namespace Sotr\Crypto\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_TestCase;

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

	public static function buildMockedNonceGenerator(
		PHPUnit_Framework_TestCase $testCase,
		$returnedNonce = 1
	) {
		$nonceGeneratorMock = $testCase->getMockBuilder('Sotr\Crypto\NonceGeneratorInterface')
			->getMock();
		$nonceGeneratorMock->expects($testCase->once())
			->method('generateNonce')
			->will($testCase->returnValue($returnedNonce));
		return $nonceGeneratorMock;
	}

	public static function buildMockedRequestSigner(
		PHPUnit_Framework_TestCase $testCase
	) {
		$requestSignerMock = $testCase->getMockBuilder('Sotr\Crypto\RequestSignerInterface')
			->getMock();
		$requestSignerMock->expects($testCase->once())
			->method('sign')
			->will($testCase->returnArgument(0));
		return $requestSignerMock;
	}
}
