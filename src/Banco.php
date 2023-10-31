<?php
namespace Microblog;
use PDO, Exception;

abstract class Banco {
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "microblog_moura";
    
    /* Operador ? "nullable typehint" -> PHP +7.1
    Quando usado, indica que a propriedade/atributo
    da classe pode conter um valor null OU pode ser
    um o tipo PDO.
    
    Neste caso, a propriedade conexao é inicializada como
    nula, mas a partir do momento em que uma conexão é feita,
    ela passa a valer PDO. */
    private static ?PDO $conexao = null; 

    public static function conecta():PDO {
        /* Só conecte se não houver conexão...
        Se conexão for nula, faça as ações do try/catch */
        if( self::$conexao === null ){
            try {
                self::$conexao = new PDO(
                    "mysql:host=".self::$servidor."; 
                    dbname=".self::$banco.";
                    charset=utf8",
                    self::$usuario, 
                    self::$senha
                );
                self::$conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $erro) {
                die("Deu ruim: ".$erro->getMessage());
            }
        }
        return self::$conexao;
    }
}