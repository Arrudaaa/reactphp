<?php

include_once 'Conn.php';

class Aluno
{
    private $id;
    private $nome;
    private $ra;
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
     * Get the value of ra
     */
    public function getRa()
    {
        return $this->ra;
    }

    /**
     * Set the value of ra
     */
    public function setRa($ra): self
    {
        $this->ra = $ra;

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
            //CREATE PROCEDURE crud_aluno
            $sql = "CALL crud_aluno(?,?,?,?)";
            $exec = $this->con->prepare($sql);
            $exec->bindValue(1, $this->id);
            $exec->bindValue(2, mb_strtoupper($this->nome));
            $exec->bindValue(3, mb_strtoupper($this->ra));
            $exec->bindValue(4, $opcao);
            return $exec->execute() == 1 ? true : false;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    public function consultar($var_id)
    {
        try {
            $this->con = new Conn();
            $sql = "CALL listar_aluno(?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $var_id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
