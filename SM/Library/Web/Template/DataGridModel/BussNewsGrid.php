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
use SM\Library\Web\Template\DataGridModel\NewsBlock;
use SM\Library\Collection\ArrayList;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class BussNewsGrid extends DataGrid
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
        $model = "";
        $class = "display";
        
        if($list->getSize() > 0)
        {
            $firstNews = $list->get()->getObject();
            $model = "<form id=\"bussNewsForm\" action=\"".SystemConfiguration::getURLBase()."Library/Services/BussNewsService.php\" method=\"post\">
                        <input type=\"hidden\" id=\"newsDate\" name=\"newsDate\" value=\"" . $firstNews->getData() . "\">
                        <input type=\"hidden\" id=\"newsTime\" name=\"newsTime\" value=\"" . $firstNews->getHora() . "\">
                        <input type=\"hidden\" id=\"serviceOperation\" name=\"serviceOperation\" value=\"hasNewDataAvailable\">
                      </form>"; 
            $model .= "<div class=\"carouselWrapper\">		
                         <div class=\"caroulsel\">
                            <ul class=\"carouselImageList\" id=\"imageList\">";
        }
        
        for($i = 0; $i < $list->getSize(); $i++)
        {            
            
            $newsUnit = $list->get($i)->getObject();
            $newsBlock = new NewsBlock("slide".($i+1),
                                      $class,
                                      $newsUnit->getIlustracao(), 
                                      $newsUnit->getTitulo());

            $model .= $newsBlock->getGrid();
            
            if(strcmp($class, "display") == 0)
            {
                $class = "hide";
            }
        }
        
        $model .= "	</ul>
		     </div>
		   </div>";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}