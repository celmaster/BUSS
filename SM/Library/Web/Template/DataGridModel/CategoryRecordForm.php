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
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class CategoryRecordForm extends DataGrid
{
    // declaracao de metodos
    public function __construct() 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling();
    }
    
    public function gridModeling()
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                    
                    <form class=\"formStyle1\" id=\"categoryForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/CategoriaController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Nome da categoria:
                            <br><input type=\"text\" id=\"categoria\" name=\"categoria\" placeholder=\"Insira o nome da categoria\">
                        </p>
                        <p>
                            <input type=\"button\" value=\"Cadastrar\" onclick=\"recordCategory('categoryForm')\">
                        </p>
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"save\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}