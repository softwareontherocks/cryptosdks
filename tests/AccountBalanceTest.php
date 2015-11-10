<?php
namespace Sotr\Crypto\Tests;

use PHPUnit_Framework_TestCase;

use Sotr\Crypto\AccountBalance;

class AccountBalanceTest extends PHPUnit_Framework_TestCase
{
	public function testBalanceOfUnsetCurrencyIsNull()
	{
		$balance = new AccountBalance();

		$this->assertNull($balance->get('nonexisting'));
	}

	public function testBalanceIsSetOnConstructor()
	{
		$balance = new AccountBalance(['btc' => 100, 'ltc' => 50]);

		$this->assertEquals(100, $balance->get('btc'));
		$this->assertEquals(50, $balance->get('ltc'));
	}

	public function testBalanceIsSetWithSetBalance()
	{
		$balance = new AccountBalance();

		$balance->set('foo', 1000);

		$this->assertEquals(1000, $balance->get('foo'));
	}
}
