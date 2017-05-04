<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 15/09/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class NewsRecordForm extends DataGrid
{
    // declaracao de metodos
    public function __construct($categorias, $emailDoAutor) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($categorias, $emailDoAutor);
    }
    
    public function gridModeling($categorias, $emailDoAutor)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                    
                    <form class=\"formStyle1\" enctype=\"multipart/form-data\" id=\"newsForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/NoticiaController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Título da notícia:
                            <br><input type=\"text\" id=\"titulo\" name=\"titulo\" placeholder=\"Insira o título da notícia aqui\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Categoria:
                            <br> ".$categorias ."
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Imagem ilustrativa da notícia:
                            <br><input type=\"file\" id=\"ilustracao\" name=\"ilustracao\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Texto:
                            <br><textarea id=\"texto\" name=\"texto\" placeholder=\"Insira o texto da notícia aqui\"></textarea> 
                        </p>
                        <p>
                            <input type=\"button\" value=\"Postar notícia\" onclick=\"recordNews('newsForm')\">
                        </p>
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"save\">
                        <input type=\"hidden\" id=\"emailDoAutor\" name=\"emailDoAutor\" value=\"".$emailDoAutor."\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}