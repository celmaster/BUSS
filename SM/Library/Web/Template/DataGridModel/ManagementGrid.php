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
use SM\Library\Web\Template\DataGridModel\ManagementItem;
use SM\Library\Collection\ArrayList;
use SM\Configuration\SystemConfiguration;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;

// declaracao da classe
class ManagementGrid extends DataGrid
{
    // declaracao de metodos
    public function __construct(ArrayList $list, $updateAddress, $controllerScript) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($list, $updateAddress, $controllerScript);
    }
    
    public function gridModeling(ArrayList $list, $updateAddress, $controllerScript)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "<input type=\"hidden\" id=\"updateAddress\" value=\"".$updateAddress."\">";
        $model .= "<table>";
        
        $model .= $this->getTableHead($list->get()->getObject()->getContext());
        
        for($i = 0; $i < $list->getSize(); $i++)
        {            
            $model .= $this->getTableRow($list->get($i)->getObject()->getContext(), $controllerScript);
        }
       
        $model .= "</table>";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
    
    private function getTableHead(Context $context)
    {
        // retorna o cabecalho de uma tabela
        // declaracao de variaveis
        $tableHead = "<tr>";
        
        for($i = 0; $i < $context->getSize(); $i++)
        {
            $contextElement = $context->getParameters()->get($i)->getObject();
            if($contextElement->getListing())
            {
                $tableHead .= "<th>" . $contextElement->getCaption() . "</th>";
            }
        }
        
         $tableHead .= "<th>Painel</th>";
        
        $tableHead .= "</tr>";
        
        // retorno de valor
        return $tableHead;
    }
    
    private function getTableRow(Context $context, $controllerScript)
    {
        // retorna uma linha de dados de uma tabela
        // declaracao de variaveis
        $tableRow = "<tr>";
        
        for($i = 0; $i < $context->getSize(); $i++)
        {
            $contextElement = $context->getParameters()->get($i)->getObject();
            if($contextElement->getListing())
            {
                $tableRow .= "<td>" . $contextElement->getValue() . "</td>";
            }
        }
        
        $tableRow .= "<td><form class=\"formStyle3\" id=\"form".$i."\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/".$controllerScript."\" method=\"post\">";
        
        $tableRow .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('form".$i."','operation".$i."','update')\">Atualizar</a>";
        $tableRow .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('form".$i."','operation".$i."','delete')\">Deletar</a>";
        $tableRow .= "</form></td>";
        
        $tableRow .= "</tr>";
        
        // retorno de valor
        return $tableRow;
    }
}