<?php

/* Tela de avisos
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// importacao do autoload
require_once("SM/autoload.php");

// importacao de classes
use SM\Library\Web\Template\BUSSSystemTemplate;
use SM\Library\Web\Template\DataGridModel\DynamicMenu;
use SM\Library\Web\Template\DataGridModel\ContentBlock;
use SM\Library\Web\Template\DataGridModel\BussLogo;
use SM\Library\Web\Template\DataGridModel\MainMenuGrid;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Web\Template\DataGridModel\MessageGrid;
use SM\Library\IO\Session;
use SM\Configuration\DbConfiguration;

// verifica se a sessao do usuario esta aberta
if(DbConfiguration::hasSession("email"))
{

    // instanciacao da pagina via template
    $page = new BUSSSystemTemplate("BUSS - Aviso");

    // instanciacao dos blocos de conteudo
    $contentBlock = new ContentBlock();    
    $mainMenu = new MainMenuGrid();
    $bussLogo =  new BussLogo(); 
    $message = new MessageGrid(Session::get("type"), Session::get("message"));

    // acessa a variavel de sessao resposanvel por indicar a navegacao automatica
    $context = new Context();    
    $context->add(new ContextElement("Voltar", Session::get("redirect")));

    // cria uma menu dinamico
    $dynamicMenu = new DynamicMenu($context);

    // agregacao de conteudo
    $page->addContent($contentBlock->getGrid());
    $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
    $page->addContentByCommentTag("<!-- @ContentBlock -->", $bussLogo->getGrid() . 
                                                           $message->getGrid() . $dynamicMenu->getGrid());

    // impressao da pagina
    echo $page->toString();
    
}else
    {
        // redireciona para a tela de login
        SystemConfiguration::letsgoByRoot("login.php");
    }