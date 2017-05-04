<?php

/* Tela de atualizacao dos registros das noticias
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
use SM\Library\Web\Template\DataGridModel\NewsUpdateForm;
use SM\Library\Web\Template\DataGridModel\CategoryInputList;
use SM\Library\Database\CategoriaDAO;
use SM\Library\Database\NoticiaDAO;
use SM\Library\IO\Session;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\IO\Request;
use SM\Library\Utils\ProcessContext;
use SM\Library\Web\Template\DataGridModel\ContentManagement;

// verifica se a sessao de usuario esta aberta
if(DbConfiguration::hasSession("email"))
{    
    
    // obtem o id da noticia a ser atualizada
    $id = Request::getParameter("id", "post");
    
    // caso o parametro nao seja recuperado, entao o usuario e redirecionado para a pagina de gerenciamento de noticias
    if($id != null)
    {
        // instanciacao da pagina via template
        $page = new BUSSSystemTemplate("BUSS - Postagem de notícias");
    
        // instanciacao de blocos de conteudo
        $contentBlock = new ContentBlock();    
        $mainMenu = new MainMenuGrid();
        $bussLogo =  new BussLogo(); 
        $title = new MessageGrid("message", "Postagem de notícias");       
        
        // cria um contexto para com o id da noticia a ser atualizada
        $context = new Context();
        $context->add(new ContextElement("id", $id, true, false, true));

        // cria uma lista de categorias para as noticias
        $noticiaDAO = new NoticiaDAO();
        $noticia = $noticiaDAO->getObjectByCondition(ProcessContext::getCondition($context), $context);
        $categoriaDAO = new CategoriaDAO();
        $categoryInputList = new CategoryInputList($categoriaDAO->getList(), $noticia->getCategoria());    
        $contentManagement = new ContentManagement();
        
        $form = new NewsUpdateForm($noticia, $categoryInputList->getGrid());

        // agregacao de conteudo
        $page->addContent($contentBlock->getGrid());
        $page->addContentByCommentTag("<!-- @Header -->", $mainMenu->getGrid());
        $page->addContentByCommentTag("<!-- @ContentBlock -->", $title->getGrid() . $bussLogo->getGrid() . $contentManagement->getGrid());
        $page->addContentByCommentTag("<!-- @ContentManagementBlock -->", $form->getGrid());

        // impressao da pagina
        echo $page->toString();
        
    }else
        {
            SystemConfiguration::letsgoByRoot("gerenciarNoticias.php");
        }
    
}else
    {
        // redirecioa para a pagina de login
        SystemConfiguration::letsgoByRoot("login.php");
    }