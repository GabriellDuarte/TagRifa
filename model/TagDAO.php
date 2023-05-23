<?php
require_once 'DataBase.php';
require_once 'Tag.php';
class TagDAO
{
    private $pdo;
    private $erro;

    public function getErro(){
        return $this->erro;
    }

    public function __construct()
    {
        try {
            $this->pdo = (new DataBase())->connection();
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $this->erro = 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
            die;
        }
    }



    public function insert(Tag $tag): Tag|bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO Tags (nome) VALUES (:nome)");
        $dados = [
            'nome'      => $tag->getNome(),
        ];
        try {
            $stmt->execute($dados);
            return $this->selectById($this->pdo->lastInsertId());
        } catch (\PDOException $e) {
            $this->erro = 'Erro ao inserir Tag: ' . $e->getMessage();
            return false;
        }
    }

    public function selectById($id): Tag|bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tags WHERE tags.id = :id");
        try {
            if($stmt->execute(['id'=>$id])){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return (new Tag(true, $row['id'], $row['nome'], $row['creation_time'], $row['modification_time']));
            }
            return false;   
        } catch (\PDOException $e) {
            $this->erro = 'Erro ao selecionar Tag: ' . $e->getMessage();
            return false;
        }
    }

    public function listarTodos(){
        $cmdSql = "SELECT * FROM tags";
        $cx = $this->pdo->prepare($cmdSql);
        $cx->execute();
        if($cx->rowCount() > 0){
            $cx->setFetchMode(PDO::FETCH_CLASS, 'Tags');
            return $cx->fetchAll();
        }
        return false;
    }


    public function update(Tag $tag)
    {
        $stmt = $this->pdo->prepare("UPDATE tags SET nome = ? WHERE id = ?");
        $nome = $tag->nome;
        $id = $tag->id;
        try {
            $stmt->execute([ $nome, $id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception('Erro ao atualizar Tag: ' . $e->getMessage());
        }
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tags WHERE id = ?");
        try {
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception('Erro ao excluir Tag: ' . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
