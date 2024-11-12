<?php

namespace App\Connection;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class AmoCRMConnection implements ConnectionInterface
{
    public function request(string $action, string $method, array $data = []): array
    {
        $url = 'https://' . config('services.amocrm.url') .'/api/v4/' . $action;

        $headers = [
            'Authorization: ' . config('services.amocrm.long_lived_token'),
        ];

        $curl = curl_init(); // сделано костыльно через curl потому что guzzle криво передаёт токен

        if (($method === 'post')) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } else if ($method === 'get') {
            $url .= '?' . http_build_query($data);
        }

        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 0);

        $result = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

//        try
//        {
//            if ($code < 200 || $code > 204) {
//                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
//            }
//        } catch(\Exception $e)
//        {
//            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
//        }

        return json_decode($result, true);
    }
}
