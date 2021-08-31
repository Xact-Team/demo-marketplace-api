<?php

namespace App\Service;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGeckoService
{
    private CoinGeckoClient $client;

    public function __construct()
    {
        $this->client = new CoinGeckoClient();
    }

    public function getUsdValueFor(string $coin): array
    {
        return $this->client->simple()->getPrice($coin, 'usd');
    }
}
