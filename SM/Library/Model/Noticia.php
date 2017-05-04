<?php

/* Classe criada para modelar uma noticia 
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
class Noticia extends Generic implements IContextObject
{
    // declaracao de atributos
    private $id;
    private $titulo;
    private $data;
    private $hora;
    private $categoria;
    private $emailDoAutor;
    private $texto;
    private $ilustracao;
    
    // declaracao de metodos
    public function __construct($titulo = "", $data = "", $hora = "", 
            $categoria = "", $emailDoAutor = "", $texto = "", $ilustracao = "", $id = -1)
    {
        // metodo contrutor
        // inicializa a superclasse
        parent::__construct("Noticia");
        
        // inicializa atributos
        $this->id = $id;
        $this->titulo = $titulo;
        $this->data = $data;
        $this->hora = $hora;
        $this->categoria = $categoria;
        $this->emailDoAutor = $emailDoAutor;
        $this->texto = $texto;
        $this->ilustracao = $ilustracao;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    
    public function getTitulo()
    {
        return $this->titulo;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public  function setHora($hora)
    {
        $this->hora = $hora;
    }
    
    public function getHora()
    {
        return $this->hora;
    }
    
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    public function setEmailDoAutor($emailDoAutor)
    {
        $this->emailDoAutor = $emailDoAutor;
    }
    
    public function getEmailDoAutor()
    {
        return $this->emailDoAutor;
    }
    
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }
    
    public function getTexto()
    {
        return $this->texto;
    }
    
    public function setIlustracao($ilustracao)
    {
        $this->ilustracao = $ilustracao;
    }
    
    public function getIlustracao()
    {
        return $this->ilustracao;
    }

    public function getContext()
    {
        // retorna o contexto da classe
        $context = new Context();
        
        // agregacao de elementos de contexto
        $context->add(new ContextElement("id", $this->getId(), true, false, true));
        $context->add(new ContextElement("titulo", $this->getTitulo(), false, false, false));
        $context->add(new ContextElement("dataDaPostagem", $this->getData(), false, false, false));
        $context->add(new ContextElement("horaDaPostagem", $this->getHora(), false, false, false));
        $context->add(new ContextElement("categoria", $this->getCategoria()));
        $context->add(new ContextElement("emailDoAutor", $this->getEmailDoAutor()));
        $context->add(new ContextElement("texto", $this->getTexto()));
        $context->add(new ContextElement("ilustracao", $this->getIlustracao()));
        
        // retorno de valor
        return $context;
    }

    public function toString()
    {
        // retorna os dados da classe em uma string
        return "Titulo: " . $this->getTitulo() . "<br>"
                . "<br>E-mail do autor: " . $this->getEmailDoAutor() . "<br>"
                . "<br>Data: " . $this->getData() . "<br>"
                . "<br>Hora: " . $this->getHora() . "<br>"
                . "<br>Categoria: " . $this->getCategoria() . "<br>"
                . "<br>Texto: " . $this->getTexto() . "<br>"
                . "<br>Ilustracao: " . $this->getIlustracao() . "<br>"
                . "<br>ID: " . $this->getId() . "<br>";
    }

}
