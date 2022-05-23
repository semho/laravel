<?php

namespace App\Services;

class Pushall
{
    private $id;
    private $apiKey;
    protected $url = "https://pushall.ru/api.php";

    public function __construct($apiKey, $id)
    {
        $this->apiKey = $apiKey;
        $this->id = $id;
    }

    public function send($title, $text)
    {
        $data = [
            "type" => "broadcast",
            "id" => $this->id,
            "key" => $this->apiKey,
            "text" => $text,
            "title" => $title
        ];

        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $this->url,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $result = curl_exec($ch); //получить данные о рассылке
        curl_close($ch);

        return $result;
    }
}
