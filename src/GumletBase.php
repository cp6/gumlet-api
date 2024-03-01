<?php

namespace Corbpie\Gumlet;

class GumletBase
{
    private const API_KEY = 'CHANGE_ME';

    private const API_URL = 'https://api.gumlet.com/v1/';

    protected string $api_key;

    public int $response_code;

    public bool|string $response_body;

    public function __construct()
    {
        $this->api_key = self::API_KEY;
    }

    protected function ApiCall(string $method, string $url, array $params = []): array
    {
        $curl = curl_init();
        if ($method === "GET") {//GET request
            if (!empty($params)) {
                $url = sprintf("%s?%s", $url, http_build_query($params));
            }
        } elseif ($method === "POST") {//POST request
            curl_setopt($curl, CURLOPT_POST, 1);
            if (!empty($params)) {
                $data = json_encode($params);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        } elseif ($method === "PUT") {//PUT request
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            $data = json_encode($params);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } elseif ($method === "DELETE") {//DELETE request
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if (!empty($params)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            }
        }

        curl_setopt($curl, CURLOPT_URL, self::API_URL . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Accept: application/json", "Authorization: Bearer $this->api_key", "Content-Type: application/json"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);

        $this->response_body = curl_exec($curl);
        $this->response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($this->response_code >= 200 && $this->response_code < 300) {
            return json_decode($this->response_body, true) ?? [];
        }

        return [
            'http_code' => $this->response_code,
            'response' => json_decode($this->response_body, true),
        ];
    }

}