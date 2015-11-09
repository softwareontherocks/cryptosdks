<?php
namespace Sotr\Crypto\Tests\Btce;

use GuzzleHttp\Psr7\Request;
use PHPUnit_Framework_TestCase;

use Sotr\Crypto\Btce\BtceRequestSigner;
use Sotr\Crypto\Tests\TestUtils;

class BtceRequestSignerTest extends PHPUnit_Framework_TestCase
{
	public function testRequestIsCorrectlySigned()
	{
		$nonceGeneratorMock = TestUtils::buildMockedNonceGenerator($this);
		$signer = new BtceRequestSigner();
		$signer->setNonceGenerator($nonceGeneratorMock);
		$unsignedRequest = new Request('GET', 'http://foo.com', [], 'foo=bar&baz=quux');

		$signedRequest = $signer->sign($unsignedRequest, 'APIKEY', 'f00b42');

		$this->assertEquals('APIKEY', $signedRequest->getHeader('Key')[0]);
		$this->assertEquals(
			'2a32f5bebe09e7fcebfbae9ea1d6125be7fb9b526dc81b3c26f8abb70c9f02643670b88b75b690cc813f28dcb2c96e1455cfc655851dc48def84f954e42365ae',
			$signedRequest->getHeader('Sign')[0]
		);
		$this->assertEquals('nonce=1&foo=bar&baz=quux', $signedRequest->getBody()->getContents());
		$this->assertEquals($unsignedRequest->getMethod(), $signedRequest->getMethod());
		$this->assertEquals($unsignedRequest->getUri(), $signedRequest->getUri());
	}
}
