<?php
namespace Sotr\Crypto\Btce;

use RuntimeException;

use Sotr\Crypto\AbstractApi;
use Sotr\Crypto\AccountBalance;
use Sotr\Crypto\Btce\BtceCurrencyPairResolver;
use Sotr\Crypto\CurrencyPair;
use Sotr\Crypto\Ticker;

class BtceApi extends AbstractApi
{
	public function __construct($key = null, $secret = null)
	{
		parent::__construct($key, $secret);
		$this->setCurrencyPairResolver(new BtceCurrencyPairResolver());
		$this->setRequestSigner(new BtceRequestSigner());
	}

	public function getPublicBaseUri()
	{
		return 'https://btc-e.com/api/2';
	}

	public function getTradingBaseUri()
	{
		return 'https://btc-e.com/tapi';
	}

	public function getTicker(CurrencyPair $pair = null)
	{
		if (! $pair) {
			throw new RuntimeException('BTC-e ticker needs a currency pair');
		}

		$pairString = $this->resolver->resolve($pair);
		$response = $this->client->request('GET', $this->getPublicBaseUri() . '/' . $pairString . '/ticker');
		$data = json_decode($response->getBody()->getContents());
		return new Ticker(
			$data->ticker->last,
			$data->ticker->high,
			$data->ticker->low,
			$data->ticker->sell,
			$data->ticker->buy
		);
	}

	public function getBalance()
	{
		$params = ['method' => 'getInfo'];
		$request = new \GuzzleHttp\Psr7\Request('POST', $this->getTradingBaseUri(), ['Content-Type' => 'application/x-www-form-urlencoded'], http_build_query($params));
		$signed = $this->signer->sign($request, $this->key, $this->secret);
		$response = $this->client->send($signed);
		$data = json_decode($response->getBody()->getContents());
		$balance = new AccountBalance();
		foreach ($data->return->funds as $currency => $value) {
			$balance->set($currency, $value);
		}
		return $balance;
	}
}
