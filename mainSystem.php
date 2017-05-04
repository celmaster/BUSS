<?php

/* Tela principal do sistema de gerenciamento do BUSS
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
use SM\Library\Web\Template\DataGridModel\BussTitleSystem;
use SM\Library\Web\Template\DataGridModel\LogoutGrid;
use SM\Library\Web\Template\DataGridModel\ContentBlock;
use SM\Library\Web\Template\DataGridModel\BussLogo;
use SM\Library\Web\Template\DataGridModel\MainMenuGrid;
use SM\Library\Web\Template\DataGridModel\MessageGrid;

// verifica se a sessao do usuario esta aberta
if(DbConfiguration::hasSession("email"))
{
    // instanciacao da pagina via template
    $page = new BUSSSystemTemplate("BUSS - Sistema de gerenciamento");
    
    // instanciacao dos blocos de conteudo
    $contentBlock = new ContentBlock();    
    $mainMenu = new MainMenuGrid();
    $bussLogo =  new BussLogo();  
    $title = new MessageGrid("message", "Sistema de gerenciamento");

    // agregacao de conteudo
    $page->addContent($contentBlock->getGrid());
    $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
    $page->addContentByCommentTag("<!-- @ContentBlock -->", $title->getGrid() . $bussLogo->getGrid());

    // impressao da pagina
    echo $page->toString();
    
}else
    {
        // redireciona para a tela de login
        SystemConfiguration::letsgoByRoot("login.php");
    }