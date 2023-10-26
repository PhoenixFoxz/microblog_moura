<?php
namespace Microblog;
use PDO, Exception;

final class Noticia{
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private string $termo; // será usado na busca
    private PDO $conexao;

    // Propriedades cujo tipo são ASSOCIADOS à classes já existentes. Isso permitirá usar recursos destas classes à partir de Noticia.
    public Usuario $usuario;
    public Categoria $categoria;

    public function __construct(){
        // Ao criar um objeto Noticia, aproveitamos para instanciar objetos de Usuario e Categoria
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;
        $this->conexao = Banco::conecta();
    }

    public function inserir():void {
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuario_id, categoria_id) VALUES (:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)"; // parametros nomeados

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);

            // Aqui, primeiro chamamos os getters de ID do Usuario e de Categoria, para só depois associar os valores aos parâmetros da consulta SQL. Isso é possivel devido à associação entre as Classes.
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir notícias: ".$erro->getMessage());
        }
    }

    // Método para listar
    public function listar():array {
        // Se o tipo de usuario logado for admin
        if($this->usuario->getTipo() === "admin"){
            // Considere o SQL abaixo (pega tudo de todos)
        $sql = "SELECT 
                noticias.titulo, 
                noticias.data, 
                usuarios.nome as Autor, 
                noticias.id, 
                noticias.destaque
            FROM noticias INNER JOIN usuarios
            ON noticias.usuario_id = usuarios.id
            ORDER BY data DESC";
        } else {
            // Senão, considere o SQL abaixo (pega somente referente ao editor)
        $sql = "SELECT 
                titulo, 
                destaque,
                data,
                id
            FROM noticias WHERE usuario_id = :usuario_id
            ORDER BY data DESC";
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            // if($this->usuario->getTipo() === "editor"){
            // ou
            // Somente se NÃO for um admin, trate o parâmetro abaixo
            if($this->usuario->getTipo() !== "admin"){
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar notícias: ".$erro->getMessage());
        }

        return $resultado;

    } 
    
    public function listarUm():array {
        if($this->usuario->getTipo() === "admin"){
            // Carrega dados de qualquer noticia de qualquer pessoa
            $sql = "SELECT * FROM noticias WHERE id = :id";
        } else {
            // Carrega dados de qualquer noticia DELE/DELA
            $sql = "SELECT * FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            if($this->usuario->getTipo() !== "admin"){
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao atualizar a notícia: ".$erro->getMessage());
        }

        return $resultado;
    }

    // Método para upload de foto
    public function upload(array $arquivo):void {
        // Definindo os tipos válidos
        $tiposValidos = [
            "image/png", "image/jpeg", "image/gif", "image/svg+xml"
        ];

        // Verificando se o arquivo NÃO É um dos tipos válidos
        if(!in_array($arquivo["type"], $tiposValidos)){
            // Alertamos o usuário e o fazemos voltar para o form.
            die("
            <script>
            alert('Formato inválido')
            history.back();
            </script>
            ");
        }

        // Acessando APENAS o nome/extensão do arquivo
        $nome = $arquivo['name'];

        // Acessando os dados de acesso/armazenamento temporários
        $temporario = $arquivo['tmp_name'];

        // Definindo a pasta de destino das imagens no site
        $pastaFinal = "../imagens/".$nome;

        // Movemos/enviamos da área temporária para a final/destino
        move_uploaded_file($temporario, $pastaFinal);
    }

    public function atualizar():void {
        if($this->usuario->getTipo() === "admin"){
            $sql = "UPDATE noticias SET titulo = :titulo, texto = :texto, resumo = :resumo, imagem = :imagem, categoria_id = :categoria_id, destaque = :destaque WHERE id = :id";
        } else {
            $sql = "UPDATE noticias SET titulo = :titulo, texto = :texto, resumo = :resumo, imagem = :imagem, categoria_id = :categoria_id, destaque = :destaque WHERE id = :id AND usuario_id = :usuario_id";
        }
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);

            // Aqui, primeiro chamamos os getters de ID do Usuario e de Categoria, para só depois associar os valores aos parâmetros da consulta SQL. Isso é possivel devido à associação entre as Classes.
            if($this->usuario->getTipo() !== "admin"){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir notícias: ".$erro->getMessage());
        }
    }

    public function excluir():void {
        if($this->usuario->getTipo() === "admin"){
            $sql = "DELETE FROM noticias WHERE id = :id";
        } else {
            $sql = "DELETE FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            // Aqui, primeiro chamamos os getters de ID do Usuario e de Categoria, para só depois associar os valores aos parâmetros da consulta SQL. Isso é possivel devido à associação entre as Classes.
            if($this->usuario->getTipo() !== "admin"){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }

            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar notícias: ".$erro->getMessage());
        }
    }

    // Métodos da área pública

    // index.php
    public function listarDestaques():array {
        $sql = "SELECT id, titulo, resumo, imagem FROM noticias WHERE destaque = :destaque ORDER BY data DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar destaques: ".$erro->getMessage());
        }

        return $resultado;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);;
        $this->id = $id;
        return $this;
    }

    public function getData(): string {
        return $this->data;
    }

    public function setData(string $data): self {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->data = $data;
        return $this;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->titulo = $titulo;
        return $this;
    }

    public function getTexto(): string {
        return $this->texto;
    }

    public function setTexto(string $texto): self {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->texto = $texto;
        return $this;
    }

    public function getResumo(): string {
        return $this->resumo;
    }

    public function setResumo(string $resumo): self {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->resumo = $resumo;
        return $this;
    }

    public function getImagem(): string {
        return $this->imagem;
    }

    public function setImagem(string $imagem): self {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->imagem = $imagem;
        return $this;
    }

    public function getDestaque(): string {
        return $this->destaque;
    }

    public function setDestaque(string $destaque): self {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->destaque = $destaque;
        return $this;
    }

    public function getTermo(): string {
        return $this->termo;
    }

    public function setTermo(string $termo): self {
        $this->termo = filter_var($termo, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->termo = $termo;
        return $this;
    }
}





