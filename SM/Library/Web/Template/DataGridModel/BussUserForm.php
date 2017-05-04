<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 11/10/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class BussUserForm extends DataGrid
{
    // declaracao de metodos
    public function __construct($timestamp) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($timestamp);
    }
    
    public function gridModeling($timestamp)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "<form id=\"bussUserForm\" action=\"".SystemConfiguration::getURLBase()."Library/Services/UserProfileService.php\" method=\"post\">
                    <input type=\"hidden\" id=\"userFormTimestamp\" name=\"userFormTimestamp\" value=\"" . $timestamp . "\">                    
                    <input type=\"hidden\" id=\"appNameFormTimestamp\" name=\"appNameFormTimestamp\" value=\"BUSS\">
                    <input type=\"hidden\" id=\"userFormServiceOperation\" name=\"userFormServiceOperation\" value=\"hasNewProfile\">
                  </form>";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}