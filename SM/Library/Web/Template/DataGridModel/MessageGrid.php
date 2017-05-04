<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 14/09/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;

// declaracao da classe
class MessageGrid extends DataGrid
{
    // declaracao de metodos
    public function __construct($class, $message) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($class, $message);
    }
    
    public function gridModeling($class, $message)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "

<div class=\"title2 ".$class."\">
".$message."
</div>
";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}