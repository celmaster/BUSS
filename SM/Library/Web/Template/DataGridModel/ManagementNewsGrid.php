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
use SM\Library\Web\Template\DataGridModel\ManagementItemHead;
use SM\Library\Collection\ArrayList;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class ManagementNewsGrid extends DataGrid
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
        $model = "<input type=\"hidden\" id=\"updateAddress\" value=\"atualizarNoticia.php\">";
        
        $datagrid = "<div class=\"lineTitleColumn bold\">Título</div>";
        $datagrid .= "<div class=\"lineDateTimeColumn bold\">Data de Postagem</div>";
        $datagrid .= "<div class=\"lineDateTimeColumn bold\">Horário de Postagem</div>";        

        $managementItem = new ManagementItemHead($datagrid);

        $model .= $managementItem->getGrid();
        
        for($i = 0; $i < $list->getSize(); $i++)
        {            
            
            $news = $list->get($i)->getObject();
           
            $datagrid = "<div class=\"newsTitleColumn\">";
            $datagrid .= $news->getTitulo();
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"newsDateTimeColumn\">";
            $datagrid .= $news->getData();
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"newsDateTimeColumn\">";
            $datagrid .= $news->getHora();
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"managePanel\">";
            $datagrid .= "<form class=\"formStyle3\" id=\"newsForm".$i."\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/NoticiaController.php\" method=\"post\">";
            $datagrid .= "<input type=\"hidden\" name=\"id\" value=\"".$news->getId()."\">";
            $datagrid .= "<input type=\"hidden\" id=\"operation".$i."\" name=\"operation\">";
            $datagrid .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('newsForm".$i."','operation".$i."','update')\">Atualizar</a>";
            $datagrid .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('newsForm".$i."','operation".$i."','delete')\">Deletar</a>";
            $datagrid .= "</form>";
            $datagrid .= "</div>";
            
            $managementItem = new ManagementItem($datagrid);

            $model .= $managementItem->getGrid();
        }
       
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}