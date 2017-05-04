<?php

/* Classe criada para modelar um perfil de usuario para o aplicativo BUSS
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
use SM\Library\Utils\TimeStamp;

// declaracao da classe
class UserProfile extends Generic implements IContextObject
{
    // declaracao de atributos
    private $abilityToSee;
    private $fontSize;
    private $graphicalElementSize;
    private $interest;
    private $environmentGroupAddress;
    private $timeOfOccurrence;
    
    // declaracao de metodos
    public function __construct($abilityToSee = "high" , $fontSize = "small", 
                                $graphicalElementSize = "small", $interest = "",
                                $environmentGroupAddress = "BUSS",
                                $timeOfOccurrence = null) 
    {
        // metodo contrutor
        // declaracao de variaveis
        $timestamp = new TimeStamp();
        
        // inicializa a superclasse
        parent::__construct("UserProfile");
        
        // inicializa atributos
        $this->abilityToSee = $abilityToSee;
        $this->fontSize = $fontSize;
        $this->graphicalElementSize = $graphicalElementSize;
        $this->interest = $interest;
        $this->environmentGroupAddress = $environmentGroupAddress;
        
        if($timeOfOccurrence == null)
        {
            $this->timeOfOccurrence = $timestamp->currentTimeSeconds();
        }else
            {   
                $this->timeOfOccurrence = $timeOfOccurrence;
            }
    }
    
    public function setAbilityToSee($abilityToSee)
    {
        $this->abilityToSee = $abilityToSee;
    }
    
    public function getAbilityToSee()
    {
        return $this->abilityToSee;
    }
    
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }
    
    public function getFontSize()
    {
        return $this->fontSize;
    }
    
    public function setGraphicalElementSize($graphicalElementSize)
    {
        $this->graphicalElementSize = $graphicalElementSize;
    }
    
    public function getGraphicalElementSize()
    {
        return $this->graphicalElementSize;
    }
    
    public function setInterest($interest)
    {
         $this->interest = $interest;
    }
    
    public function getInterest()
    {
         return $this->interest;
    }
    
    public function setEnvironmentGroupAddress($environmentGroupAddress)
    {
        $this->environmentGroupAddress = $environmentGroupAddress;
    }
    
    public function getEnvironmentGroupAddress()
    {
        return $this->environmentGroupAddress;
    }
    
    public function setTimeOfOccurrence($timeOfOccurrence)
    {
        $this->timeOfOccurrence = $timeOfOccurrence;
    }
    
    public function getTimeOfOccurrence()
    {
        return $this->timeOfOccurrence;
    }
    
    public function getContext() 
    {
        // retorna o contexto da classe
        // declaracao de variaveis
        $context = new Context();
        
        // agregacao de elementos de contexto
        $context->add(new ContextElement("environmentGroupAddress", $this->getEnvironmentGroupAddress(), true));
        $context->add(new ContextElement("abilityToSee", $this->getAbilityToSee()));
        $context->add(new ContextElement("fontSize", $this->getFontSize()));
        $context->add(new ContextElement("graphicalElementSize", $this->getGraphicalElementSize()));
        $context->add(new ContextElement("interest", $this->getInterest()));
        $context->add(new ContextElement("timeOfOccurrence", $this->getTimeOfOccurrence()));
        
        // retorno de valor
        return $context;
    }

    public function toString()
    {
        // retorna os dados da classe em uma string
        return "Environment Group Address: " . $this->getEnvironmentGroupAddress() . "<br>"
                . "Ability To See: " . $this->getAbilityToSee() . "<br>"
                . "Font Size: " . $this->getFontSize() . "<br>"
                . "Graphical Element Size: " . $this->getGraphicalElementSize() . "<br>"
                . "Interest: " . $this->getInterest() . "<br>"
                . "Time Of Occurrence: " . $this->getTimeOfOccurrence() . "<br>";
    }

}

