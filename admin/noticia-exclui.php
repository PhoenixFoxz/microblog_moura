<?php
use Microblog\Noticia;
use Microblog\ControleDeAcesso;

require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

$noticia = new Noticia;
$noticia->setId($_GET['id']);
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$noticia->excluir();
header("location:noticias.php");