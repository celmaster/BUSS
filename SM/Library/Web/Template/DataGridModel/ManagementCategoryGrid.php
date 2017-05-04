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

// declaracao da classe
class ManagementCategoryGrid extends DataGrid
{
    // declaracao de metodos
    public function __construct(ArrayList $list) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($list);
    }
    
    public function gridModeling(ArrayList $list)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "<input type=\"hidden\" id=\"updateAddress\" value=\"atualizarCategoria.php\">";
        
        $datagrid = "<div class=\"lineTitleColumn bold\">Categoria</div>";        

        $managementItem = new ManagementItemHead($datagrid);

        $model .= $managementItem->getGrid();   
        
        
        for($i = 0; $i < $list->getSize(); $i++)
        {            
            
            $category = $list->get($i)->getObject();
           
            $datagrid = "<div class=\"categoryColumn\">";
            $datagrid .= $category->getNome();
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"managePanel\">";
            $datagrid .= "<form class=\"formStyle3\" id=\"categoryForm".$i."\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/CategoriaController.php\" method=\"post\">";
            $datagrid .= "<input type=\"hidden\" name=\"categoria\" value=\"".$category->getNome()."\">";
            $datagrid .= "<input type=\"hidden\" id=\"operation".$i."\" name=\"operation\">";
            $datagrid .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('categoryForm".$i."','operation".$i."','update')\">Atualizar</a>";
            $datagrid .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('categoryForm".$i."','operation".$i."','delete')\">Deletar</a>";
            $datagrid .= "</form>";
            $datagrid .= "</div>";
            
            $managementItem = new ManagementItem($datagrid);

            $model .= $managementItem->getGrid();
        }
       
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}