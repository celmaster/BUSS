<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 02/10/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;

// declaracao da classe
class ManagementItem extends DataGrid
{
    // declaracao de metodos
    public function __construct($item) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($item);
    }
    
    public function gridModeling($item)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "

<div class=\"managementItem\">
".$item."					
</div>
";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}