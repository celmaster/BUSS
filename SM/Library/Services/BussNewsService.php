<?php

/* Servico criado para gerenciar os dados da entidade Noticia
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */


// importacao do autoload
require_once('../../autoload.php');

// importacao de classes
use SM\Library\Database\NoticiaDAO;
use SM\Library\Database\UserProfileDAO;
use SM\Library\Model\UserProfile;
use SM\Library\Utils\TimeStamp;
use SM\Library\Utils\ProcessContext;
use SM\Library\Utils\JSONManager;
use SM\Library\IO\Request;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;

// declaracao da classe
class BussNewsService
{
    // declaracao de atributos
    private $operation;    
    
    // declaracao de metodos
    public function __construct() 
    {
        // metodo construtor
        $this->operation = Request::getParameter("serviceOperation", "post");
    }
    
    private function hasNewDataAvailable()
    {
        // verifica se ha novos dados disponiveis
        // declaracao de variaveis
        $status = 0;        
        $userProfileDAO = new UserProfileDAO();
        $newsDAO = new NoticiaDAO();
        $userProfile = new UserProfile();
        $timestamp = new TimeStamp();
        $interestCondition = null;
        $interestContext = null;
        
        // obtem o perfil de usuario
        if($userProfileDAO->getQuantityOfRegisters() > 0)
        {
            $userProfile = $userProfileDAO->getFirst();
        }
        
        // obtem a lista de interesses
        if($userProfile->getInterest() != "")
        {
            $array = JSONManager::jsonToArray($userProfile->getInterest());
            $interestContext = new Context();
            $index = 1;

            foreach ($array->{"interest"} as $value) 
            {
                $interestContext->add(new ContextElement("interest".$index, $value));
                $index += 1;
            }

            $interestCondition = ProcessContext::getConditionByFieldDisjunction($interestContext, "categoria");
        }    
        
        // obtem a primeira noticia
        $firstNews = $newsDAO->getObjectByNavigation(0, $interestContext, $interestCondition); 
        
        // obtem os parametros de data e hora da noticia mais recente do aplicativo BUSS
        $date = Request::getParameter("newsDate", "post");
        $time = Request::getParameter("newsTime", "post");
        
        // converte a data e horario de postagem em segundos para comparacao
        $firstNewsTimeSeconds = $timestamp->getStrDateToSeconds($firstNews->getData()) 
                                + $timestamp->getStrTimeToSeconds($firstNews->getHora());
        
        $newsTimeSeconds = $timestamp->getStrDateToSeconds($date) 
                                + $timestamp->getStrTimeToSeconds($time);
        
        if($newsTimeSeconds > $firstNewsTimeSeconds)
        {
            // altera o valor da variavel logica
            $status = 1;
        }
        
        // imprime o valor na tela
        echo $status;
    }
    
    public function execService()
    {
        // executa o servico        
        switch($this->operation)
        {
            case "hasNewDataAvailable":                
                $this->hasNewDataAvailable();
            break;    
        }
    }
    
}

// inicia o servico
$service = new BussNewsService();
$service->execService();
