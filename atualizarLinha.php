<?php

/* Modulo para atualizacao dos registros das linhas de onibus
 * 
 * Marcelo Barbosa, 
 * outubro, 2016.
 */

// inclusao do autoload
require_once('SM/autoload.php');

// inclusao das classes
use SM\Configuration\SystemConfiguration;
use SM\Configuration\DbConfiguration;
use SM\Library\Web\Template\BUSSSystemTemplate;
use SM\Library\Web\Template\DataGridModel\ContentBlock;
use SM\Library\Web\Template\DataGridModel\BussLogo;
use SM\Library\Web\Template\DataGridModel\MainMenuGrid;
use SM\Library\Web\Template\DataGridModel\MessageGrid;
use SM\Library\Web\Template\DataGridModel\LineUpdateForm;
use SM\Library\Database\LinhaDAO;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Utils\ProcessContext;
use SM\Library\IO\Request;
use SM\Library\Web\Template\DataGridModel\ContentManagement;

// verifica se a sessao de usuario esta aberta
if(DbConfiguration::hasSession("email"))
{
    // obtem a categoria que sera atualizada
    $id = Request::getParameter("id", "post");
    $horarioIda = Request::getParameter("horarioDeIda", "post");
    $horarioVolta = Request::getParameter("horarioDeVolta", "post");
    $diaDaSemana = Request::getParameter("diaDaSemana", "post");
    
    $premise = ($id != null) && ($horarioIda != null) && ($horarioVolta != null) && ($diaDaSemana != null);
    
    // se a categoria for nula, entao o usuario e redirecionado para a tela principal do sistema
    if($premise)
    {
        $timestamp = new SM\Library\Utils\TimeStamp();
        
        // cria um contexto para a recuperacao de dados
        $horarioDeIda = $timestamp->getStrTimeToSeconds($horarioIda);
        $horarioDeVolta = $timestamp->getStrTimeToSeconds($horarioVolta);
        $context = new Context();
        $context->add(new ContextElement("id", $id));
        $context->add(new ContextElement("horarioIda", $horarioDeIda));
        $context->add(new ContextElement("horarioVolta", $horarioDeVolta));
        $context->add(new ContextElement("diaDaSemana", $diaDaSemana));
        
        // instanciacao da pagina via template
        $page = new BUSSSystemTemplate("BUSS - Atualização de dados das linhas de ônibus");
        
        // instanciacao dos blocos de conteudo
        $contentBlock = new ContentBlock();    
        $mainMenu = new MainMenuGrid();
        $bussLogo =  new BussLogo(); 
        $title = new MessageGrid("message", "Atualização de dados das linhas de ônibus"); 
        $contentManagement = new ContentManagement();
        
        // obtem o registro da categoria para atualizacao
        $linhaDAO = new LinhaDAO();
        $form = new LineUpdateForm($linhaDAO->getObjectByCondition(ProcessContext::getCondition($context), $context));
        
        // agregacao de conteudo
        $page->addContent($contentBlock->getGrid());
        $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
        $page->addContentByCommentTag("<!-- @ContentBlock -->", $title->getGrid() . $bussLogo->getGrid() . $contentManagement->getGrid());
        $page->addContentByCommentTag("<!-- @ContentManagementBlock -->", $form->getGrid());

        // impressao da pagina
        echo $page->toString();
    }else
        {
            // redireciona para a tela do sistema principal
            SystemConfiguration::letsgoByRoot("mainSystem.php");
        }
    
}else
    {
        // redireciona para a tela de login
        SystemConfiguration::letsgoByRoot("login.php");
    }