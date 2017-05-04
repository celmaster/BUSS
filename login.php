<?php

/* Tela de login do sistema de gerenciamento do BUSS
 * 
 * Marcelo Barbosa, 
 * setembro, 2016.
 */

// inclusao do autoload
require_once('SM/autoload.php');

// inclusao das classes
use SM\Library\Web\Template\BUSSSystemTemplate;
use SM\Library\Web\Template\DataGridModel\BussTitleSystem;
use SM\Library\Web\Template\DataGridModel\BussLoginForm;
use SM\Library\Web\Template\DataGridModel\ContentBlock;
use SM\Library\Web\Template\DataGridModel\ContentManagement;

// instanciacao da pagina via template
$page = new BUSSSystemTemplate("BUSS - Tela de login");

// instanciacao dos blocos de conteudo
$contentBlock = new ContentBlock();
$loginForm = new BussLoginForm();
$title = new BussTitleSystem();
$contentManagement = new ContentManagement();

// agregacao de conteudo
$page->addContent($contentBlock->getGrid());
$page->addContentByCommentTag("<!-- @Header -->", $title->getGrid());
$page->addContentByCommentTag("<!-- @ContentBlock -->", $contentManagement->getGrid());
$page->addContentByCommentTag("<!-- @ContentManagementBlock -->", $loginForm->getGrid());

// impressao da pagina
echo $page->toString();

