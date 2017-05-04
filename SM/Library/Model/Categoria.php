<?php

/* Classe criada para modelar uma categoria 
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
class Categoria extends Generic implements IContextObject
{
    // declaracao de atributos
    private $nome;
    
    // declaracao de metodos
    public function __construct($nome = "") 
    {
        // metodo construtor
        // inicializa a superclasse
        parent::__construct("Categoria");
        
        // inicializa atributos
        $this->nome = $nome;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function getContext()
    {
        // retorna o contexto da classe
        $context = new Context();
        
        // agregacao de elementos
        $context->add(new ContextElement("nome", $this->getNome(), true, false));
        
        // retorno de valor
        return $context;
        
    }

    public function toString()
    {
        // retorna os dados da classe em uma string
        return "Nome: " . $this->getNome() . "<br>";
    }

}

