<?php
use Microblog\Usuario;
use Microblog\ControleDeAcesso;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();
$sessao->verificaAcessoAdmin();

$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->excluir();
header("location:usuarios.php");