<?php
namespace Sotr\Crypto\Btce;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Request;
use Sotr\Crypto\AbstractRequestSigner;

class BtceRequestSigner extends AbstractRequestSigner
{
	public function sign(RequestInterface $request, $key, $secret, $customerId = null)
	{
		$nonce = $this->nonceGenerator->generateNonce();

		parse_str($request->getBody()->getContents(), $params);
		$params = array_merge(['nonce' => $nonce], $params);
		$query = http_build_query($params);

		$signature = hash_hmac('sha512', $query, $secret);

		$headers = array_merge(
			$request->getHeaders(),
			['Key' => $key, 'Sign' => $signature]
		);

		return new Request(
			$request->getMethod(),
			$request->getUri(),
			$headers,
			$query
		);
	}
}
