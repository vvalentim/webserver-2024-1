<?php

namespace Api;

use Core\Validator;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Throwable;

final class ViaCep {
    public const URI = "https://viacep.com.br/ws/";

    public static function json(string $cep): array {
        try {
            $cep = preg_replace("/\D/", "", $cep);

            if (!Validator::isValidCEP($cep)) {
                throw new Exception("O CEP inválido.");
            }

            $client = new Client();
            $req = new Request("GET", static::URI."{$cep}/json");
            $res = $client->sendAsync($req)->wait();
            $endereco = json_decode($res->getBody());

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