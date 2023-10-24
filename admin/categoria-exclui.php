<?php
use Microblog\ControleDeAcesso;
use Microblog\Categoria;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();
$sessao->verificaAcessoAdmin();

$categoria = new Categoria;
$categoria->setId($_GET["id"]);
$categoria->excluir();
header("location:categorias.php");