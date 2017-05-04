<?php

/* Classe criada para modelar um usuario
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// declaracao do namespace
namespace SM\Library\Model;

// importacao de classes
use SM\Library\Generic\Generic;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Interfaces\IContextObject;

// declaracao da classe
class Usuario extends Generic implements IContextObject
{
    // declaracao de atributos    
    private $email;
    private $senha;
    private $nome;
    private $sobrenome;
    private $descricao;    
    
    // declaracao de metodos
    public function __construct($email = "", $senha = "", $nome = "", $sobrenome = "", $descricao = "") 
    {
        // metodo construtor
        // inicializa a superclasse
        parent::__construct("Autor");
        
        // inicializacao de atributos
        $this->email = $email;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->descricao = $descricao;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    
    public function getSenha()
    {
        return $this->senha;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }
    
    public function getSobrenome()
    {
        return $this->sobrenome;
    }
    
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getContext() 
    {
        // retorna o contexto da classe
        $context = new Context();
        
        // agregacao de elementos
        $context->add(new ContextElement("email", $this->getEmail(), true, false));
        $context->add(new ContextElement("senha", $this->getSenha(), false, true));
        $context->add(new ContextElement("nome", $this->getNome(), false, false));
        $context->add(new ContextElement("sobrenome", $this->getSobrenome(), false, false));
        $context->add(new ContextElement("descricao", $this->getDescricao(), false, false));
        
        // retorno de valor
        return $context;
    }

    public function toString() 
    {
        // retorna os dados da classe em uma string
        return "E-Mail: " . $this->getEmail()
               . "<br>Nome: " . $this->getNome()
               . "<br>Sobrenome: " . $this->getSobrenome()
               . "<br>Descricao: " . $this->getDescricao() . "<br>";
    }

}

