INSERT INTO usuarios (username, email, hash_senha) VALUES (
    'admin',
    'admin@admin.com',
    '$2y$10$4ognoJWK1RYp.81fOffjVu4xfK1EqH37sYKPhH6smKEQEwFEO.Fne' -- 123abc
), (
    'corretor',
    'corretor@corretor.com',
    '$2y$10$07Y240rWQw66Knbhnh76Aem2va/GxhZ7lxrrRB0rM3xRVb9z3iUJq' -- 123456
);

INSERT INTO pessoas (
    nome,
    documento_tipo,
    documento,
    nascimento,
    cep,
    endereco_numero,
    endereco_complemento
) VALUES (
    'João da Silva',
    'F',
    '01234567890',
    '1990-01-01',
    '84022140',
    '1001',
    ''
), (
    'ACME Comércio LTDA',
    'J',
    '89771088000159',
    '1990-01-01',
    '84022130',
    '344',
    'Quadra J'
);

INSERT INTO telefones (id_pessoa, numero_telefone) VALUES (
    (SELECT id FROM pessoas WHERE documento = '01234567890'),
    '(42) 98800-2000'
), (
    (SELECT id FROM pessoas WHERE documento = '01234567890'),
    '(42) 3220-0000'
), (
    (SELECT id FROM pessoas WHERE documento = '01234567890'),
    '(42) 99999-9999'
), (
    (SELECT id FROM pessoas WHERE documento = '89771088000159'),
    '(42) 3221-1111'
);

INSERT INTO imoveis (
    id_proprietario,
    titulo,
    descricao,
    tipo,
    finalidade,
    preco,

    qntd_quartos,
    qntd_banheiros,
    qntd_suites,
    qntd_garagem,

    area_util,
    area_total,
    cep,
    endereco_numero,
    endereco_complemento
) VALUES (
    (SELECT id FROM pessoas WHERE documento = '01234567890'),
    'Casarão Rua Ricetti',
    'Sit amet commodo nulla facilisi nullam vehicula ipsum a arcu',
    'Casa',
    'V',
    1250000.00,
    4,
    3,
    2,
    4,
    420.00,
    1632.50,
    '84022130',
    '121',
    'Em frente a loja ABC'
);

INSERT INTO leads (
    nome,
    email,
    telefone,
    assunto,
    mensagem
) VALUES (
    'José',
    'jose@mail.com',
    '(47) 99000-2222',
    'Compra',
    'Velit dignissim sodales ut eu sem integer vitae justo eget magna fermentum iaculis eu non diam phasellus vestibulum lorem sed'
);