## Introdução

O objetivo desse projeto é criar uma aplicação web como um exercício avaliativo para a disciplina de _desenvolvimento web servidor_ durante o primeiro semestre de 2024.

O tema escolhido para o projeto é _sistema web para imobiliárias_.

Os participantes desse projeto são: 
- João Victor Valentim 
- Guilherme Czarnecki Oconoski.

### Organização do projeto

Esse projeto vai consistir em três etapas, onde o código será separado após cada entrega. Dessa forma o ambiente, as dependências e instruções podem variar de acordo com cada etapa do projeto.

### Ambientes e configurações utilizadas localmente

1. Ubuntu 22.04.4 LTS (WSL2)
- PHP 8.1.2
- PostgreSQL 14.11 (Ubuntu 14.11-0ubuntu0.22.04.1)

2. Vercel
- Node v20.10.0
- Vercel CLI 34.0.0

### Instalação e execução

```
git clone https://github.com/vvalentim/webserver-2024-1.git

cd webserver-2024-1/

composer install
```

Os arquivos de teste para usar o banco de dados podem ser encontrados na pasta __schema__.

#### Para desenvolvimento local pelo _Built-in PHP webserver_:

É necessário definir as variáveis de ambiente, crie o arquivo `.env` e defina o acesso ao banco de acordo com o exemplo `.env.example`

```
composer dev
```

#### Para utilizar a runtime _vercel-php_ e fazer deploy na Vercel:

Instale o interface de terminal da Vercel e configure seu login.

```
# Instale o pacote globalmente
npm i -g vercel

# Realize o login
vercel login
```

Pelo site da Vercel, crie um projeto e mude a versão do Node.js que será utilizada para 18.x (padrão é 20.x porém está com problemas).

```
Project Settings > General > Node.js Version
```

Ainda no site da Vercel, configure as variáveis de ambiente. Você deve especificar o acesso ao banco de dados de acordo com o exemplo `.env.example`: 

```
Project Settings > Environment Variables
```

> [!NOTE]
> Após adicionar pacotes Composer, utilize a flag --force para ignorar o _build cache_ nos deploys pelo CLI.

### Recursos

- [Composer: para gerenciar as dependências do projeto](https://getcomposer.org/)
- [Vercel: para deploy da aplicação](https://vercel.com/)
- [Railway: para deploy de uma instância Postgres](https://railway.app/)
