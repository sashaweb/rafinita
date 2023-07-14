<?php

namespace App\Clients\Rafinita;

use GuzzleHttp;
use GuzzleHttp\Exception\ClientException;

class RafinitaClient
{

    private $_client;
    
    private const CLIENT_PASS = 'd0ec0beca8a3c30652746925d5380cf3';
    private const CLIENT_KEY = '5b6492f0-f8f5-11ea-976a-0242c0a85007';
    private const BASE_URI = 'https://dev-api.rafinita.com/post';

    function __construct()
    {
        $this->_client = new GuzzleHttp\Client(['base_uri' => self::BASE_URI]);
    }

    private function _generateHash($email, $cardNumber)
    {
        return md5(strtoupper(strrev($email).self::CLIENT_PASS.strrev(substr($cardNumber,0,6).substr($cardNumber,-4))));
    }

    public function sale($params)
    {
        $params['hash'] = $this->_generateHash($params['payer_email'], $params['card_number']);
        $params['client_key'] = self::CLIENT_KEY;

        try {
            $response = $this->_client->post('', ['form_params' => $params]);
            return \json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            return \json_decode($e->getResponse()->getBody()->getContents());
        }
    }

}

