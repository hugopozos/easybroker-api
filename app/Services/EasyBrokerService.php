<?php

namespace App\Services;

use App\Contracts\Services\EasyBrokerServiceInterface;
use GuzzleHttp\Client;

class EasyBrokerService implements EasyBrokerServiceInterface
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.stagingeb.com/v1/']);
        $this->apiKey = config('easybroker.api_key');
    }

    public function getContactRequests($page, $limit)
    {
        $response = $this->client->request('GET', 'contact_requests', [
            'headers' => [
                'X-Authorization' => $this->apiKey,
                'Accept' => 'application/json',
            ],
            'query' => [
                'page' => $page,
                'limit' => $limit,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }


}
