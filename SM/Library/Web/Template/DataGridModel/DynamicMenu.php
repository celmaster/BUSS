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
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;

// declaracao da classe
class DynamicMenu extends DataGrid
{
    // declaracao de metodos
    public function __construct(Context $context) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($context);
    }
    
    public function gridModeling(Context $context)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "<form class=\"formStyle1\" id=\"menuForm\" action=\"\" method=\"post\">\n";
                                              
         for($i = 0; $i < $context->getParameters()->getSize(); $i++)
         {
             $model .= $this->getButton($context->getParameters()->get($i)->getObject()) . "\n";
         }
        
         $model .= "</form>\n";
                 
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
    
    private function getButton(ContextElement $contextElement)
    {
        // obtem um botao dinamico
        return "<p>
                    <input type=\"button\" value=\"".$contextElement->getCaption()."\" onclick=\"letsgo('".$contextElement->getValue()."')\">
                    <br><br>
                </p>";
    }
}