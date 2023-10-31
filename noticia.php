<?php

use Microblog\Utilitarios;

require_once "inc/cabecalho.php";
$noticia->setId($_GET["id"]);
$dados = $noticia->listarDetalhes();
?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2> <?=$dados['titulo']?> </h2>
        <p class="font-weight-light">
            <time><?=Utilitarios::formataData($dados['data'])?></time> - 
            <span><?=$dados['autor']?></span>
        </p>
        <img src="imagens/<?=$dados['imagem']?>" alt="" class="float-start pe-2 img-fluid">
        <p class="ajusta-texto"><?=$dados['texto']?></p>
    </article>
    

</div>        
                  

<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

