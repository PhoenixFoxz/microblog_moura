<?php
namespace Microblog;
use Exception, PDO;

final class Categoria {
    private int $id;
    private string $nome;
    private PDO $conexao;

    public function __construct(){
        $this->conexao = Banco::conecta();
    }


    /* Métodos para rotinas de CRUD no Banco */

    // INSERT de Categoria
    public function inserir():void {
        $sql = "INSERT INTO categorias(nome) VALUES(:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir categoria: ".$erro->getMessage());
        }
    }

    // SELECT de Categorias
    public function listar():array {
        $sql = "SELECT * FROM categorias ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao listar categorias: ".$erro->getMessage());
        }

        return $resultado;
    }

    // SELECT de Categoria
    public function listarUm():array {
        $sql = "SELECT * FROM categorias WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }

        return $resultado;
    }

    // UPDATE de Categoria
    public function atualizar():void {
        $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar categoria: ".$erro->getMessage());
        }
    }

    // DELETE de Categoria
    public function excluir():void {
        $sql = "DELETE FROM categorias WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao excluir categoria: ".$erro->getMessage());
        }
    }



    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);;
        return $this;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

   
    public function setNome(string $nome): self
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }
}