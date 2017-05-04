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
use SM\Library\Utils\TimeStamp;

// declaracao da classe
class ManagementLineGrid extends DataGrid
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
        $model = "<input type=\"hidden\" id=\"updateAddress\" value=\"atualizarLinha.php\">";
        $timestamp = new TimeStamp();
        
        $datagrid = "<div class=\"lineTitleColumn bold\">ID <span class=\"yellowEmphases\">:</span> Origem  <span class=\"yellowEmphases\">/</span>  Destino</div>";
        $datagrid .= "<div class=\"lineDateTimeColumn bold\">Horário de Partida</div>";
        $datagrid .= "<div class=\"lineDateTimeColumn bold\">Horário de Volta</div>";        

        $managementItem = new ManagementItemHead($datagrid);

        $model .= $managementItem->getGrid();
        
        for($i = 0; $i < $list->getSize(); $i++)
        {            
            
            $line = $list->get($i)->getObject();
           
            $datagrid = "<div class=\"lineTitleColumn\">";
            $datagrid .= $line->getId() . " <span class=\"yellowEmphases\">:</span> " . $line->getOrigem() . "  <span class=\"yellowEmphases\">/</span>  " . $line->getDestino();
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"lineDateTimeColumn\">";
            $datagrid .= $timestamp->getTimeBySeconds($line->getHorarioDeIda());
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"lineDateTimeColumn\">";
            $datagrid .= $timestamp->getTimeBySeconds($line->getHorarioDeVolta());
            $datagrid .= "</div>";
            $datagrid .= "<div class=\"managePanel\">";
            $datagrid .= "<form class=\"formStyle3\" id=\"lineForm".$i."\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/LinhaController.php\" method=\"post\">";
            $datagrid .= "<input type=\"hidden\" name=\"id\" value=\"".$line->getId()."\">";
            $datagrid .= "<input type=\"hidden\" name=\"horarioDeIda\" value=\"".$timestamp->getTimeBySeconds($line->getHorarioDeIda())."\">";
            $datagrid .= "<input type=\"hidden\" name=\"horarioDeVolta\" value=\"".$timestamp->getTimeBySeconds($line->getHorarioDeVolta())."\">";
            $datagrid .= "<input type=\"hidden\" name=\"diaDaSemana\" value=\"".$line->getDiaDaSemana()."\">";
            $datagrid .= "<input type=\"hidden\" id=\"operation".$i."\" name=\"operation\">";
            $datagrid .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('lineForm".$i."','operation".$i."','update')\">Atualizar</a>";
            $datagrid .= "<a class=\"linkButton\" href=\"javascript:sendFormForManagement('lineForm".$i."','operation".$i."','delete')\">Deletar</a>";
            $datagrid .= "</form>";
            $datagrid .= "</div>";
            
            $managementItem = new ManagementItem($datagrid);

            $model .= $managementItem->getGrid();
        }
       
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}