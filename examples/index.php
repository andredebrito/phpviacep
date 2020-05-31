<?php
require '../vendor/autoload.php';

use AndreDeBrito\PHPViaCep\PhpViaCep;

$findByCep = (new PhpViaCep())->findByCep("01001000")->json()->fetch()->jsonToObject();
$findByAddress = (new PhpViaCep())->findByAddress("SP", "Poá", "Avenida Brasil")->json()->fetch()->jsonToObject();
?>
<html>
    <head>
        <title>PHPViaCep exemplos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    </head>

    <body class="bg-light">

    <container>

        <div class="bg-white container" style="padding-top: 20px; padding-bottom: 20px;">
            <header class="text-center" style="margin-bottom: 15px;">
                <h1>Classe PhpViaCep</h1>
            </header>

            <p>
                Este projeto tem por objetivo consumir o webservice ViaCEP. 
                Utilizando o PHP e CURL.
            </p>

            <p>
                Baseado no webservice <a href="https://viacep.com.br/" target="_blank">https://viacep.com.br/</a>.
                Através dessa classe é possível consultar e obter dados de endereços com retorno nos formatos
                <b>JSON</b>, <b>XML</b>, <b>PIPED</b> e <b>QWERT</b>.
            </p>

            <div>
                <h4>Bibliotecas e tecnlogias utiladas</h4>
                <ul>
                    <li>PHP 7.2</li>
                    <li>CURL</li>
                </ul>
            </div>

            <div>
                <h4>Exemplos de utilização</h4>

                <div id="cep">
                    <h5>Pesquisa por CEP</h5>
                    <p>
                        Instancie um novo objeto da classe PhpViaCep e invoque o método <code>findByCep()</code>
                        passando o CEP como parâmentro, utilize uma opção de retorno (<code>json</code>, <code>json_unicode</code>, <code>xml</code>, <code>piped</code> ou <code>querty</code>),
                        invoque o método <code>fetch()</code> (no exemplo abaixo foi utilizado o método <code>jsonToObject</code> para
                        tornar o response e um objeto).
                        Utilize o método <code>getResponse()</code> para exibir os dados.
                    </p>


                    <div class="bg-secondary text-light" style="padding: 15px;">
                        <code class="text-light">
                            require '../vendor/autoload.php';<br><br>

                            use AndreDeBrito\PHPViaCep\PhpViaCep;<br><br>

                            $findByCep = (new PhpViaCep())->findByCep("01001000")->json()->fetch()->jsonToObject();
                        </code>
                    </div>

                    <div style="margin-top: 20px;">
                        <p><b>Resultado jsonToObject:</b></p>
                        <code class="text-light bg-light">
                            <?= var_dump($findByCep->getResponse()); ?>
                        </code>

                        <p><b>Resultado XML:</b></p>
                        <code class="text-light bg-light">
                            <div class="bg-secondary" style="padding: 15px;">
                                <code class="text-light">
                                    $findByCep = (new PhpViaCep())->findByCep("01001000")->xml()->fetch();
                                </code>
                            </div>
                            <?php $findByCep = (new PhpViaCep())->findByCep("01001000")->xml()->fetch(); ?>
                            <?= var_dump($findByCep->getResponse()); ?>
                        </code>

                        <p><b>Resultado PIPED:</b></p>
                        <code class="text-light bg-light">
                            <div class="bg-secondary" style="padding: 15px;">
                                <code class="text-light">
                                    $findByCep = (new PhpViaCep())->findByCep("01001000")->piped()->fetch();
                                </code>
                            </div>
                            <?php $findByCep = (new PhpViaCep())->findByCep("01001000")->piped()->fetch(); ?>
                            <?= var_dump($findByCep->getResponse()); ?>
                        </code>

                        <p><b>Resultado QUERTY:</b></p>
                        <code class="text-light bg-light">
                            <div class="bg-secondary" style="padding: 15px;">
                                <code class="text-light">
                                    $findByCep = (new PhpViaCep())->findByCep("01001000")->querty()->fetch();
                                </code>
                            </div>
                            <?php $findByCep = (new PhpViaCep())->findByCep("01001000")->querty()->fetch(); ?>
                            <?= var_dump($findByCep->getResponse()); ?>
                        </code>

                    </div>
                </div>


                <div style="margin-top: 50px;" id="address">
                    <h5>Pesquisa por Endereço</h5>
                    <p>
                        Instancie um novo objeto da classe PhpViaCep e invoque o método <code>findByAddress()</code>
                        passando UF, Cidade e Endereço como parâmentros, utilize uma opção de retorno (<code>json</code>, <code>json_unicode</code> ou <code>xml</code>),
                        invoque o método <code>fetch()</code> (no exemplo abaixo foi utilizado o método <code>jsonToObject</code> para
                        tornar o response e um objeto).
                        Utilize o método <code>getResponse()</code> para exibir os dados.
                    </p>
                    
                    
                    <div class="bg-secondary text-light" style="padding: 15px;">
                        <code class="text-light">
                            require '../vendor/autoload.php';<br><br>

                            use AndreDeBrito\PHPViaCep\PhpViaCep;<br><br>

                            $findByAddress = (new PhpViaCep())->findByAddress("SP", "Poá", "Avenida Brasil")->json()->fetch()->jsonToObject();
                        </code>
                    </div>

                    <div style="margin-top: 20px;">
                        <p><b>Resultado jsonToObject:</b></p>
                        <code class="text-light bg-light">
                            <?= var_dump($findByAddress->getResponse()); ?>
                        </code>

                        <p><b>Resultado XML:</b></p>
                        <code class="text-light bg-light">
                            <div class="bg-secondary" style="padding: 15px;">
                                <code class="text-light">
                                    $findByAddress = (new PhpViaCep())->findByAddress("SP", "Poá", "Avenida Brasil")->xml()->fetch();
                                </code>
                            </div>
                            <?php $findByAddress = (new PhpViaCep())->findByAddress("SP", "Poá", "Avenida Brasil")->xml()->fetch(); ?>
                            <?= var_dump($findByAddress->getResponse()); ?>
                        </code>


                    </div>
                </div>
            </div>

            
            <div style="margin-top: 50px;">
                <h4>Tratamento de erros</h4>
                <p>
                    Caso o retorno do método <code>getResponse()</code> seja null utilize o método 
                    <code>getError()</code> para visualizar o erro.
                </p>
            </div>
        </div>

    </container>
</body>
</html>

