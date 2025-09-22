<?php

include_once 'Conn.php';

class Curso
{
    private $id;
    private $nome;
    private $con;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of con
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * Set the value of con
     */
    public function setCon($con): self
    {
        $this->con = $con;

        return $this;
    }

    public function crud($opcao)
    {
        try {
            $this->con = new Conn();
            //CREATE PROCEDURE crud_curso 
            $sql = "CALL crud_curso(?,?,?)";
            $exec = $this->con->prepare($sql);
            $exec->bindValue(1, $this->id);
            $exec->bindValue(2, mb_strtoupper($this->nome));
            $exec->bindValue(3, $opcao);
            return $exec->execute() == 1 ? true : false;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    public function consultar($var_id)
    {
        try {
            $this->con = new Conn();
            $sql = "CALL listar_curso(?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $var_id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
