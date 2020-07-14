# PhpViaCep

[![Build](https://img.shields.io/scrutinizer/build/g/andredebrito/phpviacep.svg?style=flat-square)](https://scrutinizer-ci.com/g/andredebrito/phpviacep)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/andredebrito/phpviacep.svg?style=flat-square)](https://scrutinizer-ci.com/g/andredebrito/phpviacep)

Este projeto tem por objetivo consumir o webservice ViaCEP. Utilizando o PHP e CURL.

Baseado no webservice https://viacep.com.br/. Através dessa classe é possível consultar e obter dados de endereços com retorno nos formatos **JSON**, **XML**, **PIPED** e **QWERT**.

## Bibliotecas e tecnlogias utiladas
- PHP 7.2
- CURL

# Instalação
Via composer:

`"andredebrito/phpviacep": "^1.0"`

ou execute:

`composer require andredebrito/phpviacep`


## Exemplos de utilização
### Pesquisa por CEP
Instancie um novo objeto da classe PhpViaCep e invoque o método `findByCep()` passando o CEP como parâmentro, utilize uma opção de retorno (`json()`, `json_unicode()`, `xml()`, `piped()` ou `querty()`), invoque o método` fetch()` (no exemplo abaixo foi utilizado o método `jsonToObject()` para tornar o response e um objeto). Utilize o método `getResponse()` para exibir os dados.

#### Retorno em Objeto
```php
require '../vendor/autoload.php;

use AndreDeBrito\PHPViaCep\PhpViaCep;

$findByCep = (new PhpViaCep())->findByCep("01001000")
	      ->json()->fetch()
	      ->jsonToObject();

var_dump($findByCep->getResponse());
```

#### Retorno em XML:
```php
$findByCep = (new PhpViaCep())->findByCep("01001000")
	      ->xml()
	      ->fetch();

var_dump($findByCep->getResponse());
```

#### Retorno em PIPED:
```php
$findByCep = (new PhpViaCep())->findByCep("01001000")
	      ->piped()
	      ->fetch();

var_dump($findByCep->getResponse());
```

#### Retorno em QUERTY:
```php
$findByCep = (new PhpViaCep())->findByCep("01001000")
	      ->querty()
	      ->fetch();

var_dump($findByCep->getResponse());
```

### Pesquisa por Endereço
Instancie um novo objeto da classe PhpViaCep e invoque o método `findByAddress()` passando UF, Cidade e Endereço como parâmentros, utilize uma opção de retorno (`json()`, `json_unicode()` ou `xml()`), invoque o método `fetch()` (no exemplo abaixo foi utilizado o método `jsonToObject()` para tornar o response e um objeto). Utilize o método `getResponse()` para exibir os dados.

#### Retorno em Objeto
```php
require '../vendor/autoload.php';

use AndreDeBrito\PHPViaCep\PhpViaCep;

$findByAddress = (new PhpViaCep())->findByAddress("SP", "Poá", "Avenida Brasil")
		  ->json()
		  ->fetch()
		  ->jsonToObject();

var_dump($findByAddress->getResponse());
```

#### Retorno em XML
```php
$findByAddress = (new PhpViaCep())->findByAddress("SP", "Poá", "Avenida Brasil")
		  ->xml()
		  ->fetch();

var_dump($findByAddress->getResponse());
```

## Tratamento de Erros
Caso o retorno do método `getResponse()` seja **null** utilize o método `getError()` para visualizar o erro.

#### Exemplo
```php
if($findByAddress->getError()){
    echo $findByAddress->getError();
}

```