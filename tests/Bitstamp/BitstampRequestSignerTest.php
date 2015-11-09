<?php
namespace Sotr\Crypto\Tests\Bitstamp;

use GuzzleHttp\Psr7\Request;
use PHPUnit_Framework_TestCase;

use Sotr\Crypto\Bitstamp\BitstampRequestSigner;
use Sotr\Crypto\Tests\TestUtils;

class BitstampRequestSignerTest extends PHPUnit_Framework_TestCase
{
	public function testRequestIsCorrectlySigned()
	{
		$nonceGeneratorMock = TestUtils::buildMockedNonceGenerator($this);
		$signer = new BitstampRequestSigner();
		$signer->setNonceGenerator($nonceGeneratorMock);
		$unsignedRequest = new Request('GET', 'http://foo.com', [], 'foo=bar&baz=quux');

		$signedRequest = $signer->sign($unsignedRequest, 'APIKEY', 'f00b42', 5);

		parse_str($signedRequest->getBody()->getContents(), $requestBody);
		$this->assertEquals('APIKEY', $requestBody['key']);
		$this->assertEquals(1, $requestBody['nonce']);
		$this->assertEquals('f3d649b1e4911bbc9e2f65208dabbfb83e467bfdceea3fc27010a0c4cfa15a96', $requestBody['signature']);
		$this->assertEquals('bar', $requestBody['foo']);
		$this->assertEquals('quux', $requestBody['baz']);
		$this->assertEquals($unsignedRequest->getMethod(), $signedRequest->getMethod());
		$this->assertEquals($unsignedRequest->getUri(), $signedRequest->getUri());
		$this->assertEquals($unsignedRequest->getHeaders(), $signedRequest->getHeaders());
	}
}
