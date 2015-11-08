<?php
namespace Sotr\Crypto\Btce;

use Sotr\Crypto\AbstractApi;
use Sotr\Crypto\Ticker;

class BtceApi extends AbstractApi
{
	public function getBaseUri()
	{
		return 'https://btc-e.com/api/2';
	}

	public function getTicker($pair = null)
	{
		$response = $this->client->request('GET', $this->getBaseUri() . '/btc_usd/ticker');
		$data = json_decode($response->getBody()->getContents());
		return new Ticker(
			$data->ticker->last,
			$data->ticker->high,
			$data->ticker->low,
			$data->ticker->sell,
			$data->ticker->buy
		);
	}
}
