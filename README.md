Evoke Network - Guia de Instalação
==================================

O projeto Evoke utiliza CakePHP em sua fundação, sendo gerenciado pelo [Composer](https://getcomposer.org/, "Composer"). Os pacotes de frontend são gerenciados pelo [Bower](http://bower.io/, "Bower"). O Bower roda sobre [Node.js](http://nodejs.org/, "Node.js") e precisa do gerenciador de pacotes do Node - o NPM - para funcionar. Para realizar a instalação do ambiente de desenvolvimento em seu servidor, siga os passos abaixo.

## Instalação ##

Vá até o site do Node.js, baixe o instalador e execute-o ou utilize o comando a seguir no terminal (ou Prompt de comando)

```
	curl -sS https://getcomposer.org/installer | php

```

Caso você não tenha o cURL instalado, faça o comando a seguir ao invés do anterior

```
	php -r "readfile('https://getcomposer.org/installer');" | php

```

Instale o Bower utilizando o comando a seguir

```
	sudo npm install -g bower

```

Mude o diretório atual para o diretório raíz do seu projeto e crie o arquivo `composer.json`

```
	
	{
		"name": "evoke",
		"repositories": [
		{
			"type": "pear",
			"url": "http://pear.cakephp.org"
		}
		],
			"require": {
			"pear-cakephp/cakephp": ">=2.4.0"
		},
			"config": {
			"vendor-dir": "Vendor/"
		}
	}

```

Execute o Composer para que ele baixe as bibliotecas do CakePHP

```
	php composer.phar install

```

Aguarde até todas o dowload de todos os arquivos estar completo, então execute o script de criação de projeto do CakePHP

```
	Vendor/bin/cake bake project .

```

Não se esqueça do ponto ao final do comando, que indica que o CakePHP precisa utilizar os arquivos base (skel) e replicar neste mesmo diretório;
Crie um arquivo `.gitignore` na raíz do seu projeto e adicione os seguintes caminhos (que não serão enviados ao Bitbucket)

```
	Vendor/
	composer.phar
	Config/database.php
	webroot/components

```

Crie um arquivo de configuração de caminhos do Bower na raíz do peojto, o `.bowerrc`, e adicione as seguintes linhas

```
	{
		"directory": "webroot/components"
	}

```

Crie um arquivo de configuração dos pacotes do Bower, o `bower.json`, na raíz do seu projeto e adicione os seguintes pacotes

```
	{
		"name": "Evoke",
		"dependencies": {
			"foundation": "5.0.3",
			"font-awesome": "v4.0.3",
			"mrmrs-colors": "master"
		}
	}

```

Execute o bower na raíz do projeto

```
	bower install

```

Execute os comandos de Add e Commit do Git. Agora basta executar os comandos a seguir no terminal (ou Prompt de comando)

```
	git update-index --assume-unchanged Config/core.php
	git update-index --assume-unchanged tmp/

```

Desta forma, garantimos que estes arquivos irão para o repositório remoto, porém as modificações locais não serão consideradas.