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
class MainMenuGrid extends DataGrid
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
        $model = "<div class=\"menu\">					
                    <div class=\"dropdown\">
                            <div class=\"dropdownTitle\">...:: Acesso Rápido ::..</div>
                            <div class=\"dropdownContent\">
                                <div class=\"dropdownItem\" onclick=\"letsgo('mainSystem.php')\">*Página inicial</div>
                                <div class=\"dropdownItem\" onclick=\"letsgo('categorias.php')\">Categoria de notícias</div>
                                <div class=\"dropdownItem\" onclick=\"letsgo('noticias.php')\">Notícias</div>
                                <div class=\"dropdownItem\" onclick=\"letsgo('linhas.php')\">Linhas dos ônibus</div>                                    
                                <div class=\"dropdownItem\" onclick=\"letsgo('usuario.php')\">Atualizar usuário</div>
                                <div class=\"dropdownItem lastItem\" onclick=\"letsgo('logout.php')\">Logout</div>
                            </div>
                    </div>
                    <div class=\"logout\">
                            <div class=\"logoutButton\" onclick=\"navPage('logout.php')\"></div>
                    </div>
            </div>";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}