<?php

/* Modulo para atualizacao dos registros das categorias
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
use SM\Library\Web\Template\DataGridModel\CategoryUpdateForm;
use SM\Library\Database\CategoriaDAO;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Utils\ProcessContext;
use SM\Library\IO\Request;
use SM\Library\Web\Template\DataGridModel\ContentManagement;

// verifica se a sessao de usuario esta aberta
if(DbConfiguration::hasSession("email"))
{
    // obtem a categoria que sera atualizada
    $categoria = Request::getParameter("categoria", "post");
    
    // se a categoria for nula, entao o usuario e redirecionado para a tela principal do sistema
    if($categoria != null)
    {
        // cria um contexto para a recuperacao de dados
        $context = new Context();
        $context->add(new ContextElement("nome", $categoria));
        
        // instanciacao da pagina via template
        $page = new BUSSSystemTemplate("BUSS - Atualização de dados das categorias");
        
        // instanciacao dos blocos de conteudo
        $contentBlock = new ContentBlock();    
        $mainMenu = new MainMenuGrid();
        $bussLogo =  new BussLogo(); 
        $title = new MessageGrid("message", "Atualização de dados das categorias"); 
        $contentManagement = new ContentManagement();
        
        // obtem o registro da categoria para atualizacao
        $categoriaDAO = new CategoriaDAO();
        $form = new CategoryUpdateForm($categoriaDAO->getObjectByCondition(ProcessContext::getCondition($context), $context));
        
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