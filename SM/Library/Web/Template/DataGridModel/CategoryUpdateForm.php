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
use SM\Library\Model\Categoria;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class CategoryUpdateForm extends DataGrid
{
    // declaracao de metodos
    public function __construct(Categoria $category) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($category);
    }
    
    public function gridModeling(Categoria $category)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                    
                    <form class=\"formStyle1\" id=\"categoryForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/CategoriaController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Nome da categoria:
                            <br><input type=\"text\" id=\"categoria\" name=\"categoria\" value=\"".$category->getNome()."\" placeholder=\"Insira o nome da categoria\">                            
                        </p>
                        <p>
                            <input type=\"button\" value=\"Atualizar\" onclick=\"updateCategory('categoryForm')\">
                        </p>
                        <p>
                            <input type=\"button\" class=\"backButton\" value=\"Voltar para a tela de gerenciamento\" onclick=\"navPage('gerenciarCategorias.php')\">
                        </p>
                        <input type=\"hidden\" id=\"nomeAntigoDaCategoria\" name=\"nomeAntigoDaCategoria\" value=\"".$category->getNome()."\">
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"update\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}