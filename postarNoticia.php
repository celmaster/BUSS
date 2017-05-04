<?php

/* Tela de postagem de noticias
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
use SM\Library\Web\Template\DataGridModel\ContentBlock;
use SM\Library\Web\Template\DataGridModel\BussLogo;
use SM\Library\Web\Template\DataGridModel\MainMenuGrid;
use SM\Library\Web\Template\DataGridModel\MessageGrid;
use SM\Library\Web\Template\DataGridModel\NewsRecordForm;
use SM\Library\Web\Template\DataGridModel\CategoryInputList;
use SM\Library\Database\CategoriaDAO;
use SM\Library\IO\Session;
use SM\Library\Web\Template\DataGridModel\ContentManagement;

// verifica se a sessao de usuario esta aberta
if(DbConfiguration::hasSession("email"))
{
    // instanciacao da pagina via template
    $page = new BUSSSystemTemplate("BUSS - Postagem de notícias");
    
    // instanciacao de blocos de conteudo
    $contentBlock = new ContentBlock();    
    $mainMenu = new MainMenuGrid();
    $bussLogo =  new BussLogo(); 
    $title = new MessageGrid("message", "Postagem de notícias");       
    
    // cria uma lista de categorias para as noticias
    $categoriaDAO = new CategoriaDAO();
    $categoryInputList = new CategoryInputList($categoriaDAO->getList());    
    $contentManagement = new ContentManagement();
    $form = new NewsRecordForm($categoryInputList->getGrid(), Session::get("email"));

    // agregacao de conteudo
    $page->addContent($contentBlock->getGrid());
    $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
    $page->addContentByCommentTag("<!-- @ContentBlock -->", $title->getGrid() . $bussLogo->getGrid() . $contentManagement->getGrid());
    $page->addContentByCommentTag("<!-- @ContentManagementBlock -->", $form->getGrid());

    // impressao da pagina
    echo $page->toString();
    
}else
    {
        // redirecioa para a pagina de login
        SystemConfiguration::letsgoByRoot("login.php");
    }