<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

// Estou pegando as classes padrões do Composer, essas classes
// eu estou usando para fazer a busca no HTTP.

class Buscador
{
    /**
     * @var ClientInterface  Classe Definida do Composer
    */
    private $httpClient;
    /**
     * @var Crawler  // Classes Definida do Composer
    */
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        // Estou buscando "por array" os cursos no html especificado
        // no outro arquivo buscar-cursos.php (que é o HTML da Alura.com.br)

        $resposta = $this->httpClient->request('GET', $url);
        // Estou pegando essa variável httpClient e dando um request
        // nela, pegando como GET e a url.

        $html = $resposta->getBody();     // Só quero pegar o corpo do HTML.
        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];
        // crio uma variável onde vai ter os elementos dos curos , e então eu passo
        // o crawler para ele fazer o filtro do que será exibido, no meu caso
        // eu quero exibir os "cards", que no site da Alura estão os cursos
        // e dentro disso eu peguei o nome da classe (do html, class="") e onde
        // estava, dentro de que ? (no caso span).

        // Logo depois eu criei uma variável para armazenar o Array desses cursos.
        // $cursos = [];

        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        // Fiz o foreach para pegar os elementos dentro do HTML que será apresentado e
        // do que será apresentado, e estou jogando esses elementos dentro da variável
        // que criamos para armazenar o Array dos cursos, e aprensentando ele como TextContent

        return $cursos;
    }
}

/* Aqui eu criei uma classe exclusivamente para eu fazer a busca dos meus Cursos
no site da Alura */

// Com o comando:
// vendor\bin\phpcs --standard=PSR12  pasta_do_arquivo
// conseguimos analisar o padrão do nosso código.
// Esse PHPCS serve apenas para ver o padrão do nosso código, padrão PSR 12
// PSR 4, etc..
// https://www.php-fig.org/psr/psr-12/
