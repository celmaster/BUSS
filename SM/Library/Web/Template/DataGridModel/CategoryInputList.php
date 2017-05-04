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
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Collection\ArrayList;
use SM\Library\Model\Categoria;
use SM\Library\Utils\StringManager;


// declaracao da classe
class CategoryInputList extends DataGrid
{
    // declaracao de metodos
    public function __construct(ArrayList $list, $value = null) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($list, $value);
    }
    
    public function gridModeling(ArrayList $list, $value = null)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "<select size=\"1\" id=\"categoria\" name=\"categoria\">\n";
        $model .= "<option value=\"#\">Selecione</option>";
        
        if($value == null)
        {
            $value = "";
        }
                                              
        for($i = 0; $i < $list->getSize(); $i++)
        {            
            $model .= $this->getOption($list->get($i)->getObject(), $value) . "\n";
        }
        
         $model .= "</select>\n";
                 
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
    
    private function getOption(Categoria $categoria, $value)
    {
        // obtem um botao dinamico
        $selected = "";
        
        if(StringManager::equalsIgnoreCase($categoria->getNome(), $value))
        {
            $selected = " selected";
        }
        
        return "<option value=\"".$categoria->getNome()."\"".$selected.">".$categoria->getNome()."</option>";
    }
}
