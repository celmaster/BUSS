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
class BussLoginForm extends DataGrid
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
                    
                    <form class=\"formStyle1\" id=\"loginForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/UsuarioController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            E-Mail:
                            <br><input type=\"text\" id=\"email\" name=\"email\" placeholder=\"Informe seu e-mail de login aqui\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Senha:
                            <br><input type=\"password\" id=\"senha\" name=\"senha\" placeholder=\"Insira sua senha para login aqui\">
                        </p>
                        <p>
                            <input type=\"button\" value=\"Log in\" onclick=\"makeLogin('loginForm')\">
                        </p>
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"login\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}