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

// declaracao da classe
class News extends DataGrid
{
    // declaracao de metodos
    public function __construct() 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling();
    }
    
    public function gridModeling()
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                
                <div class=\"news\">
                    <!-- @News -->
                    		
                </div> 
                ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}