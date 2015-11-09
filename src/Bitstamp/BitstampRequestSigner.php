<?php
namespace Sotr\Crypto\Bitstamp;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Request;
use Sotr\Crypto\AbstractRequestSigner;

class BitstampRequestSigner extends AbstractRequestSigner
{
	public function sign(RequestInterface $request, $key, $secret, $customerId = null)
	{
		$nonce = $this->nonceGenerator->generateNonce();

		$signature = hash_hmac('sha256', $nonce . $customerId . $key, $secret);

		parse_str($request->getBody()->getContents(), $params);
		$params = array_merge(
			['key' => $key, 'nonce' => $nonce, 'signature' => $signature],
			$params
		);
		$body = http_build_query($params);

		return new Request(
			$request->getMethod(),
			$request->getUri(),
			$request->getHeaders(),
			$body
		);
	}
}
