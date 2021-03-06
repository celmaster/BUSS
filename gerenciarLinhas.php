<?php

/* Tela de gerenciamento dos registros das linhas dos onibus
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
use SM\Library\Web\Template\DataGridModel\ContentManagement;
use SM\Library\Web\Template\DataGridModel\ManagementLineGrid;
use SM\Library\Web\Template\DataGridModel\MessageGrid;
use SM\Library\Database\LinhaDAO;
use SM\Library\Utils\PageManager;

// verifica se a sessao do usuario esta aberta
if(DbConfiguration::hasSession("email"))
{
    // instanciacao da pagina via template
    $page = new BUSSSystemTemplate("BUSS - Gerenciar linhas dos ônibus");
    
    // instanciacao dos blocos de conteudo
    $contentBlock = new ContentBlock();    
    $mainMenu = new MainMenuGrid();
    $bussLogo =  new BussLogo(); 
    $contentManagement = new ContentManagement();
    $title = new MessageGrid("message", "Gerenciar linhas dos ônibus");
    
    // criacao do subaplicativo de paginacao de registros
    $linhaDAO = new LinhaDAO();
    $pagination = new PageManager(10, $linhaDAO->getQuantityOfRegisters());
    $pagination->setFirstCaption("Primeira página");
    $pagination->setPriorCaption("Anterior");
    $pagination->setNextCaption("Próxima");
    $pagination->setLastCaption("Última página");
    
    // criacxao da lista dinamica de registros
    $managementLineGrid = new ManagementLineGrid($linhaDAO->getList(null, null, "id", $pagination->getIndex(), $pagination->getNumberRecordsPerPages()));
    
    // agregacao de conteudo
    $page->addContent($contentBlock->getGrid());
    $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
    $page->addContentByCommentTag("<!-- @ContentBlock -->", $title->getGrid() . 
                                                           $bussLogo->getGrid() . 
                                                           $pagination->toPageByLinks(5) . 
                                                           $contentManagement->getGrid());    
    
    $page->addContentByCommentTag("<!-- @ContentManagementBlock -->", $managementLineGrid->getGrid());

    // impressao da pagina
    echo $page->toString();
    
}else
    {
        // redireciona para a tela de login
        SystemConfiguration::letsgoByRoot("login.php");
    }