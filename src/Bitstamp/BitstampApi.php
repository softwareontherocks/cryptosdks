<?php
namespace Sotr\Crypto\Bitstamp;

use Sotr\Crypto\AbstractApi;
use Sotr\Crypto\Ticker;

class BitstampApi extends AbstractApi
{
	public function getBaseUri()
	{
		return 'https://www.bitstamp.net/api';
	}

	public function getTicker($pair = null)
	{
		$response = $this->client->request('GET', $this->getBaseUri() . '/ticker');
		$data = json_decode($response->getBody()->getContents());
		return new Ticker(
			$data->last,
			$data->high,
			$data->low,
			$data->bid,
			$data->ask
		);
	}
}
