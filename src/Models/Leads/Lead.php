<?php

namespace Models\Leads;

use Core\ActiveRecord;

/**
 * @method string nome()
 * @method string email()
 * @method string telefone()
 * @method string assunto()
 * @method string mensagem()
 * 
 * @method Lead setNome(string $nome)
 * @method Lead setEmail(string $email)
 * @method Lead setTelefone(string $telefone)
 * @method Lead setAssunto(string $assunto)
 * @method Lead setMensagem(string $mensagem)
 */
final class Lead extends ActiveRecord {
    protected const TABLE = "leads";

    protected string $nome;
    protected string $email;
    protected string $telefone;
    protected string $assunto;
    protected string $mensagem;
}