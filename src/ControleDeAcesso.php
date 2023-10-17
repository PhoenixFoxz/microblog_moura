<?php 
namespace Microblog;
use PDO, Exception;

final class ControleDeAcesso {
    public function __construct()
    {
        // Se NÃO EXISTIR uma sessão "em andamento"
        if(!isset($_SESSION)){
            // então inicialize uma sessão
            session_start();
        }
    }

    public function verificaAcesso(): void
    {
        // Se NÃO EXISTIR uma variável de sessão chamada "id" (ou seja, ainda não houve um login por parte do usuário)
        if( !isset($_SESSION['id']) )
        // ...então destrua qualquer resquício de sessão, redirecione para o formulário de login e pare completamente o script.
        {
            session_destroy();
            header("location:../login.php");
            die(); // ou exit;
        }
    }
}