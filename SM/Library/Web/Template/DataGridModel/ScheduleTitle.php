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
class ScheduleTitle extends DataGrid
{
    // declaracao de metodos
    public function __construct($title) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($title);
    }
    
    public function gridModeling($title)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                
                <div class=\"scheduleTitle title whiteTitle\">
                    ".$title."					
                </div>
                ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}