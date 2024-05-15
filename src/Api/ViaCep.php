<?php

namespace Api;

use Core\Validator;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Throwable;

final class ViaCep {
    public const URI = "https://viacep.com.br/ws/";

    protected static function guzzleRequest(string $cep): object {
        $client = new Client();
        $req = new Request("GET", static::URI."{$cep}/json");
        $res = $client->sendAsync($req)->wait();
        
        return json_decode($res->getBody());
    }

    protected static function curlRequest(string $cep): object {
        $handler = curl_init();
        $headers = ["Referer: {$_SERVER['HTTP_REFERER']}"];
        
        curl_setopt($handler, CURLOPT_URL, static::URI."{$cep}/json");
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handler, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($handler);
        curl_close($handler);

        return json_decode($response);
    }

    public static function json(string $cep): array {
        try {
            $cep = preg_replace("/\D/", "", $cep);

            if (!Validator::isValidCEP($cep)) {
                throw new Exception("O CEP inválido.");
            }

            $endereco = static::guzzleRequest($cep);

            if (!isset($endereco->erro)) {
                return [
                    "uf" => $endereco->uf,
                    "localidade" => $endereco->localidade,
                    "bairro" => $endereco->bairro,
                    "logradouro" => $endereco->logradouro
                ];
            }
        } catch (Throwable) {}

        return [];
    }
}