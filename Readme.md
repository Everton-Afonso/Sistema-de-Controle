# Sistema de Controle

## Requisitos para poder gerar o relátorio:

No projeto utilizamos o **Dompdf versão 0.8.5** para poder gerar relatorios de componentes cadastrados.

**Dompdf** é um renderizador orientado a estilo: ele baixa e lê folhas de estilo externas, tags de estilo embutidas e os atributos de estilo de elementos HTML individuais. Ele também suporta a maioria dos atributos HTML de apresentação.

_Para mais informações acesse [Documentação Dompdf](https://github.com/dompdf/dompdf#dompdf)._

Link do repositorio Github _[Clique aqui](https://github.com/dompdf/dompdf)._
Download da versão do [Dompdf 0.8.5](https://github.com/dompdf/dompdf/releases), basta clicar em **dompdf_0-8-5.zip**.

## Preparação do ambiente para a utilização do Dompdf

Depois de efetuar o download, basta ir no diretorio onde o download foi salvo e descompactar o arquivo **dompdf_0-8-5.zip** em seguida copiar a pasta **dompdf_0-8-5** descompacitada e colar na pasta de seu projeto.

### Exemplo de utilização

Exemplo da pagina pdf.php

```
<?php
    use Dompdf\Dompdf; // usando o Dompdf para não ocorer erros
    // include autoloader
    require_once 'dompdf/autoload.inc.php'; //incluindo o autoload da pasta dompdf

    $dompdf = new DOMPDF();

    ob_start();
    require_once 'teste.php'; // renderiza a pagina teste.php
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->setPaper("A4"); // definindo o formato da folha
    $dompdf->render();
    $dompdf->stream(
        "Relatorio.pdf", // definendo o nome do arquivo
        ["Attachment" => false] // colocando a opção de download automatico como falso
    );
?>
```

Exemplo da pagina teste.php

```
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Teste</h1>
    <p>Cadastro:
        <?php
        date_default_timezone_set('America/Sao_Paulo');
        echo date('d-m-Y H:i:s'); // mostrando data e hora atual
        ?>
    </p>
</body>
</html>
```

Exemplo da pagina index.html

```
<!DOCTYPE html>
<html lang="pr-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
	</head>
	<body>
		<a target="_brack" href="pdf.php">Gerar relatorio</a>
	</body>
</html>
```
