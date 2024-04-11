INSERT INTO grupos_usuarios (tipo) VALUES ('administrador');
INSERT INTO grupos_usuarios (tipo) VALUES ('corretor');

INSERT INTO usuarios (id_grupo_usuario, nome, email, hash_senha) VALUES (
    (SELECT id FROM grupos_usuarios WHERE tipo = 'administrador'),
    'admin',
    'admin@admin.com',
    '$2y$10$4ognoJWK1RYp.81fOffjVu4xfK1EqH37sYKPhH6smKEQEwFEO.Fne' -- 123abc
), (
    (SELECT id FROM grupos_usuarios WHERE tipo = 'corretor'),
    'corretor',
    'corretor@corretor.com',
    '$2y$10$ZKyW7oO2KO7UQUhLbDh1oOroq98paDLr3XgY1yMIVXO3f.jR02P02' -- 12345
);

INSERT INTO pessoas (
    nome_razao,
    tipo_pessoa,
    tipo_vinculo,
    documento,
    data_nasc_fund,
    cep,
    numero,
    complemento
) VALUES (
    'João da Silva',
    'F',
    'CLI',
    '12312312300',
    '1990-01-01',
    '84022140',
    '1001',
    'Ap 33'
), (
    'ACME Comércio LTDA',
    'J',
    'CLI',
    '12345678000300',
    '1990-01-01',
    '84022130',
    '344',
    'Quadra J'
);

INSERT INTO telefones (id_pessoa, numero) VALUES (
    (SELECT id FROM pessoas WHERE documento = '12312312300'),
    '(42) 98800-2000'
), (
    (SELECT id FROM pessoas WHERE documento = '12312312300'),
    '(42) 3220-0000'
), (
    (SELECT id FROM pessoas WHERE documento = '12312312300'),
    '(42) 99999-9999'
), (
    (SELECT id FROM pessoas WHERE documento = '12345678000300'),
    '(42) 3221-1111'
);

INSERT INTO imoveis (
    id_proprietario,
    tipo_imovel,
    finalidade,
    qntd_quartos,
    qntd_banheiros,
    qntd_suites,
    qntd_garagem,
    area_util,
    area_total,
    preco,
    titulo,
    descricao,
    cep,
    numero,
    complemento
) VALUES (
    (SELECT id FROM pessoas WHERE documento = '12345678000300'),
    'Casa',
    'V',
    4,
    3,
    2,
    4,
    420.00,
    1632.50,
    1250000.00,
    'Casarão Rua Ricetti',
    'Sit amet commodo nulla facilisi nullam vehicula ipsum a arcu',
    '84022130',
    '121',
    ''
);