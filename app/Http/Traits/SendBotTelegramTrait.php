<?php
namespace App\Http\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

trait SendBotTelegramTrait {

    public function SendMessageTele($tokenBot, $teleId, $type, $message)
    {
        $client  = new Client();
        $url = "https://api.telegram.org/".$tokenBot."/sendMessage";

        $link = '';

        switch ($type) {
            case 'log-error':
                $link = url('log-viewer/logs/'.date('Y-m-d').'/error');
                break;
        }
        
        $client->request('GET', $url, [
            'json' =>[
            "chat_id" => $teleId, 
            "text" => 'Essay Editing_' . date('y/m/d') .' '. substr($message, 0, 4000) . ' ' . $link, # Limit message telegram
            ]
        ]);
    }
}