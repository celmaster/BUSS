<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 11/09/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class NewsBlock extends DataGrid
{
    // declaracao de metodos
    public function __construct($id, $class, $imageURI, $text) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($id, $class, $imageURI, $text);
    }
    
    public function gridModeling($id, $class, $imageURI, $text)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis       
        $ilustration = SystemConfiguration::getUploadFileDir() . "/" . $imageURI;
        $model = "<li id=\"".$id."\" class=\"".$class."\">
                    <div class=\"imageBox\" style=\"background-image:url('".$ilustration."'); background-size:cover; background-position:center\"></div>
                    <div class=\"textBox title\"><div class=\"textBoxContent\">".$text."</div></div>
                 </li>";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}