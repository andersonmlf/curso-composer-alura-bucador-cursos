#!/usr/bin/env php
<?php

require 'vendor/autoload.php';
// Estou dando require aqui, onde está a class Client e Crawler.

/*
Teste::Metodo();
exit();   
*/

use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' =>'https://www.alura.com.br/']);
$crawler = new Crawler();
// Estou criando o Client com a URL base do site que eu quero, No meu caso é: 
// https://www.alura.com.br/
// Essa é a URL base do site, tipo uma index.

// Criei um Crawler também.

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');
// A minha class que eu chamei, no caso Buscador, estou pegando tudo que 
// fizemos para colocar dentro dessa variável, e assim começar a mandar 
// os cursos aqui dentro.

// Nisso, vamos começar a buscar os cursos no http "filho", que seria a 
// página especifica a ser buscada, no nosso caso queremos buscar todos os
// cursos de PHP.

foreach ($cursos as $curso) {
    echo exibeMensagem($curso);
}
// O foreach para a repetição dos cursos a ser apresentado até chegar ao
// final.


// IMPORTANTE SOBRE O AUTOLOAD.
// Sempre que eu criar o meu autoload na pasta raiz do meu projeto,
// a pasta src, eu tenho que fazer o seguinte código no cmd:
// composter dump-autoload        |     composer dumpautoload
// Qualquer um dos 2 códigos acima está certo.

// O código 'files' dentro do arquivo 'composer.json' funciona
// do mesmo jeito que o classmap, mas não vai servir para classes
// e sim para arquivos como fizemos o teste com o exibeMensagem()
// Sem contar que também posso colocar vários caminhos dentro deles:
// Ex:
//
// "classmap": [
//    "./Teste.php",
//    "./Views.php",
//    "./Helpers.php"
// ],
//
// "files": [
//    "./functions.php",
//    "./text.php",
//    "./strings.php"
// ],