<?php

/* Tela de noticias
 * 
 * Marcelo Barbosa, 
 * setembro, 2016.
 */

// inclusao do autoload
require_once('SM/autoload.php');

// inclusao das classes
use SM\Configuration\SystemConfiguration;
use SM\Configuration\DbConfiguration;
use SM\Library\Web\Template\BUSSSystemTemplate;
use SM\Library\Web\Template\DataGridModel\DynamicMenu;
use SM\Library\Web\Template\DataGridModel\ContentBlock;
use SM\Library\Web\Template\DataGridModel\BussLogo;
use SM\Library\Web\Template\DataGridModel\MainMenuGrid;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Web\Template\DataGridModel\MessageGrid;
use SM\Library\Web\Template\DataGridModel\ContentManagement;

// verifica se a sessao do usuario esta aberta
if(DbConfiguration::hasSession("email"))
{
    // instanciacao da pagina via template
    $page = new BUSSSystemTemplate("BUSS - Notícias");
    
    // instanciacao dos blocos de conteudo
    $contentBlock = new ContentBlock();    
    $mainMenu = new MainMenuGrid();
    $bussLogo =  new BussLogo(); 
    $title = new MessageGrid("message", "Notícias");
    $contentManagement = new ContentManagement();
    
    // criacao do menu dinamico
    $context = new Context();    
    $context->add(new ContextElement("Gerenciar notícias", "gerenciarNoticias.php"));
    $context->add(new ContextElement("Postar notícia", "postarNoticia.php"));    
    $dynamicMenu = new DynamicMenu($context);

    // agregacao de conteudo
    $page->addContent($contentBlock->getGrid());
    $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
    $page->addContentByCommentTag("<!-- @ContentBlock -->", $title->getGrid() . $bussLogo->getGrid() . $contentManagement->getGrid());
    $page->addContentByCommentTag("<!-- @ContentManagementBlock -->", $dynamicMenu->getGrid());

    // impressao da pagina
    echo $page->toString();
    
}else
    {
        // redireciona para a pagina de login
        SystemConfiguration::letsgoByRoot("login.php");
    }