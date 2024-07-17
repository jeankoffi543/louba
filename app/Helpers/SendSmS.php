<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class SendSmS
{


    /**
     * @throws GuzzleException
     */
    public function send($telephone, $message_sms): ResponseInterface
    {
        $curl = new Client();
        $url = "https://smswanwaran.com/index.php";

        return $curl->request('GET', $url, [
                'query' => [
                    'app' => "ws",
                    'u' => "theonemonk",
                    "from" => env('APP_NAME'),
                    'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d",
                    'op' => "pv",
                    'to' => env('INDICATIF_NUMBER', "224") . "" . $telephone,
                    'msg' => $message_sms,
                ]
            ]
        );
    }
}
