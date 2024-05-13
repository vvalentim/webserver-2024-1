CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    hash_senha VARCHAR(255) NOT NULL
);

CREATE TABLE pessoas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL, -- nome completo ou razão social
    documento VARCHAR(14) UNIQUE NOT NULL, 
    documento_tipo CHAR(1) NOT NULL, -- F/J
    nascimento DATE NOT NULL, -- data de nascimento ou fundação
    cep VARCHAR(8) NOT NULL, -- apenas números
    endereco_numero VARCHAR(30) NOT NULL,
    endereco_complemento VARCHAR(50)
);

CREATE TABLE telefones (
    id SERIAL,
    id_pessoa INTEGER NOT NULL,
    numero_telefone VARCHAR(20) NOT NULL, -- armazenar com qualquer tipo de máscara
    FOREIGN KEY (id_pessoa) REFERENCES pessoas (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id, id_pessoa)
);

CREATE TABLE imoveis (
    id SERIAL PRIMARY KEY,
    id_proprietario INTEGER NOT NULL,

    titulo VARCHAR(30) NOT NULL,
    descricao VARCHAR(500),
    tipo VARCHAR(20) NOT NULL,
    finalidade CHAR(1) NOT NULL, -- V/A ou venda/aluguel
    preco NUMERIC(20, 2) NOT NULL,

    qntd_quartos SMALLINT NOT NULL,
    qntd_banheiros SMALLINT NOT NULL,
    qntd_suites SMALLINT NOT NULL,
    qntd_garagem SMALLINT NOT NULL,

    area_util NUMERIC(20, 2) NOT NULL,
    area_total NUMERIC(20, 2) NOT NULL,

    cep VARCHAR(8) NOT NULL, -- apenas números
    endereco_numero VARCHAR(30) NOT NULL,
    endereco_complemento VARCHAR(50),
    
    FOREIGN KEY (id_proprietario) REFERENCES pessoas (id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE leads (
	id SERIAL PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(255) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	assunto VARCHAR(100) NOT NULL,
	mensagem VARCHAR(500)
);