<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 05/10/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Model\Noticia;
use SM\Library\Web\DataGrid\DataGrid;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class NewsUpdateForm extends DataGrid
{
    // declaracao de metodos
    public function __construct(Noticia $noticia, $categorias) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($noticia, $categorias);
    }
    
    public function gridModeling(Noticia $noticia, $categorias)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                    
                    <form class=\"formStyle1\" enctype=\"multipart/form-data\" id=\"newsForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/NoticiaController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Título da notícia:
                            <br><input type=\"text\" id=\"titulo\" name=\"titulo\" placeholder=\"Insira o título da notícia aqui\" value=\"".$noticia->getTitulo()."\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Categoria:
                            <br> ".$categorias ."
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Imagem ilustrativa da notícia:
                            <br><input type=\"file\" id=\"ilustracao\" name=\"ilustracao\">                            
                        </p>
                        <p>
                            <a class=\"formButtonLink\" href=\"".SystemConfiguration::getUploadFileDir()."/".$noticia->getIlustracao()."\" target=\"_blank\">Clique aqui para visualizar imagem atual</a>
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Texto:
                            <br><textarea id=\"texto\" name=\"texto\" placeholder=\"Insira o texto da notícia aqui\">".$noticia->getTexto()."</textarea> 
                        </p>
                        <p>
                            <input type=\"button\" value=\"Atualizar notícia\" onclick=\"updateNews('newsForm')\">
                        </p>
                        <p>
                            <input type=\"button\" class=\"backButton\" value=\"Voltar para a tela de gerenciamento\" onclick=\"navPage('gerenciarNoticias.php')\">
                        </p>
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"update\">
                        <input type=\"hidden\" name=\"id\" value=\"".$noticia->getId()."\">
                        <input type=\"hidden\" name=\"dataDaPostagem\" value=\"".$noticia->getData()."\">
                        <input type=\"hidden\" name=\"horaDaPostagem\" value=\"".$noticia->getHora()."\">
                        <input type=\"hidden\" name=\"ilustracaoAntiga\" value=\"".$noticia->getIlustracao()."\">
                        <input type=\"hidden\" name=\"emailDoAutor\" value=\"".$noticia->getEmailDoAutor()."\">
                        
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}