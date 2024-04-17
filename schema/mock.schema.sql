CREATE DATABASE webserver_2024;

-- ignorar redundância dos endereços para fim de simplificação
-- e/ou
-- armazenar apenas o cep, numero e complemento (buscar o endereço em API's públicas: uf, localidade, bairro, logradouro)

CREATE TABLE pessoas (
    id SERIAL PRIMARY KEY,
    nome_razao VARCHAR(60) NOT NULL, -- nome ou razão social
    tipo_pessoa CHAR(1) NOT NULL, -- F/J ou fisica/juridica
    tipo_vinculo CHAR(3) NOT NULL, -- CLI/COL ou cliente/colaborador
    documento VARCHAR(14) UNIQUE NOT NULL, -- CPF OU CNPJ, apenas números 
    data_nasc_fund DATE NOT NULL, -- data de nascimento ou fundação

    cep VARCHAR(8) NOT NULL, -- apenas números
    numero VARCHAR(30) NOT NULL,
    complemento VARCHAR(50)
);

CREATE TABLE telefones (
    id SERIAL,
    id_pessoa INTEGER NOT NULL,
    numero VARCHAR(20) NOT NULL, -- armazenar com qualquer tipo de máscara
    FOREIGN KEY (id_pessoa) REFERENCES pessoas (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id, id_pessoa)
);

CREATE TABLE grupos_usuarios (
    id SERIAL PRIMARY KEY,
    tipo VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    id_grupo_usuario INTEGER NOT NULL,
    nome VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    hash_senha VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_grupo_usuario) REFERENCES grupos_usuarios (id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE imoveis (
    id SERIAL PRIMARY KEY,
    id_proprietario INTEGER NOT NULL,

    tipo_imovel VARCHAR(20) NOT NULL,
    finalidade CHAR(1) NOT NULL, -- V/A ou venda/aluguel
    qntd_quartos SMALLINT NOT NULL,
    qntd_banheiros SMALLINT NOT NULL,
    qntd_suites SMALLINT NOT NULL,
    qntd_garagem SMALLINT NOT NULL,
    area_util NUMERIC(6, 2) NOT NULL,
    area_total NUMERIC(6, 2) NOT NULL,
    preco NUMERIC(9,2) NOT NULL,
    titulo VARCHAR(30) NOT NULL,
    descricao TEXT,

    cep VARCHAR(8) NOT NULL, -- apenas números
    numero VARCHAR(30) NOT NULL,
    complemento VARCHAR(50),

    imagem_path VARCHAR(255),
    
    FOREIGN KEY (id_proprietario) REFERENCES pessoas (id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE leads (
	id SERIAL PRIMARY KEY,
	name VARCHAR(200) NOT NULL,
	phone VARCHAR(16) NOT NULL,
	email VARCHAR(200) NOT NULL,
	subject VARCHAR(100) NOT NULL,
	message TEXT
);