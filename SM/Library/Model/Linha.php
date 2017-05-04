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
class Linha extends Generic implements IContextObject
{
    // declaracao de atributos
    private $id;
    private $horarioDeIda;
    private $horarioDeVolta;
    private $origem;
    private $destino;
    private $diaDaSemana;
    
    // declaracao de metodos
    public function __construct($id = "", $horarioDeIda = "",  $horarioDeVolta = "", $diaDaSemana = "", $origem = "", $destino = "")
    {
        // metodo construtor
        // inicialiaza a superclasse
        parent::__construct("Linha do itinerario");
        
        // inicializa atributos
        $this->id = $id;
        $this->horarioDeIda = $horarioDeIda;
        $this->horarioDeVolta = $horarioDeVolta;
        $this->diaDaSemana = $diaDaSemana;
        $this->origem = $origem;
        $this->destino = $destino;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setHorarioDeIda($horarioDeIda)
    {
        $this->horarioDeIda = $horarioDeIda;
    }
    
    public function getHorarioDeIda()
    {
        return $this->horarioDeIda;
    }
    
    public function setHorarioDeVolta($horarioDeVolta)
    {
       $this->horarioDeVolta = $horarioDeVolta;
    }
    
    public function getHorarioDeVolta()
    {
        return $this->horarioDeVolta;
    }
    
    public function setDiaDaSemana($diaDaSemana)
    {
        $this->diaDaSemana = $diaDaSemana;
    }
    
    public function getDiaDaSemana()
    {
        return $this->diaDaSemana;
    }
    
    public function setOrigem($origem)
    {
        $this->origem = $origem;
    }
    
    public function getOrigem()
    {
        return $this->origem;
    }
    
    public function setDestino($destino)
    {
        $this->destino = $destino;
    }
    
    public  function getDestino()
    {
        return $this->destino;
    }
    
    public function getContext()            
    {
        // retorna o contexto da classe
        $context = new Context();
        
        // agregacao de elementos de contexto
        $context->add(new ContextElement("id", $this->getId(), true, false, false));
        $context->add(new ContextElement("horarioIda", $this->getHorarioDeIda(), true, false, false));
        $context->add(new ContextElement("horarioVolta", $this->getHorarioDeVolta(), true, false, false));
        $context->add(new ContextElement("diaDaSemana", $this->getDiaDaSemana(), true, false));
        $context->add(new ContextElement("origem", $this->getOrigem(), false, false, false));
        $context->add(new ContextElement("destino", $this->getDestino(), false, false, false));
        
        // retorno de valor
        return $context;
    }

    public function toString()
    {
        // retorna os dados da classe em uma string
        return "ID: " . $this->getId() . "<br>"
                 . "<br>Horario de ida: " . $this->getHorarioDeIda() . "<br>"
                 . "<br>Horario de volta: " . $this->getHorarioDeVolta() . "<br>"
                 . "<br>Dia da semana: " . $this->getDiaDaSemana() . "<br>"
                 . "<br>Origem: " . $this->getOrigem() . "<br>"
                 . "<br>Destino: " . $this->getDestino() . "<br>";
    }

}