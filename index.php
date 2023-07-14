<?php

require __DIR__ . '/vendor/autoload.php';

use App\Clients\Rafinita\RafinitaClient;

$client = new RafinitaClient();

$params = [
    "action" => "SALE",
    "order_id" => "ORDER-123456",
    "order_amount" => "1.99",
    "order_currency" => "USD",
    "order_description" => "Product",
    "card_number" => "4111111111111111",
    "card_exp_month" => "01",
    "card_exp_year" => "2025",
    "card_cvv2" => "000",
    "payer_first_name" => "John",
    "payer_last_name" => "Doe",
    "payer_address" => "Big street",
    "payer_country" => "US",
    "payer_state" => "CA",
    "payer_city" => "City",
    "payer_zip" => "123456",
    "payer_email" => "doe@example.com",
    "payer_phone" => "199999999",
    "payer_ip" => "123.123.123.123",
    "term_url_3ds" => "http://client.site.com/return.php",
];

$response = $client->sale($params);

echo $response->result;

echo '<pre>';
print_r($response);
echo '</pre>';

if ($response->result == 'SUCCESS') {
    // success handler
} elseif ($response->result == 'DECLINED') {
    // declined handler
} else {
    // error handler
}
