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
        // https://smswanwaran.com/index.php?app=ws&u=theonemonk&from=RDV-DCPAF&h=67a3e2c5fab0c9f5e4df3286de3f7b5d&op=pv&to=224628748484&msg=TEST+SMS
        $curl = new Client();
        $url = "https://smswanwaran.com/index.php";

        return $curl->request('GET', $url, [
                'query' => [
                    'app' => "ws",
                    'u' => "theonemonk",
                    "from" => "RDV-DCPAF",
                    'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d",
                    'op' => "pv",
                    'to' => env('INDICATIF_NUMBER', "224") . "" . $telephone,
                    'msg' => $message_sms,
                ]
            ]
        );
    }
}
