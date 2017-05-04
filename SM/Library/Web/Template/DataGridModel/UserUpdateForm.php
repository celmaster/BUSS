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
use SM\Library\Model\Usuario;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class UserUpdateForm extends DataGrid
{
    // declaracao de metodos
    public function __construct(Usuario $usuario) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($usuario);
    }
    
    public function gridModeling(Usuario $usuario)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                    
                    <form class=\"formStyle1\" id=\"userForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/UsuarioController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Nome:
                            <br><input type=\"text\" id=\"nome\" name=\"nome\" value=\"".$usuario->getNome()."\" placeholder=\"Insira seu nome aqui\">                            
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Sebrenome:
                            <br><input type=\"text\" id=\"sobrenome\" name=\"sobrenome\" value=\"".$usuario->getSobrenome()."\" placeholder=\"Insira seu sobrenome aqui\">                            
                        </p>
                        <p class=\"title1 whiteTitle\">
                            E-mail:
                            <br><input type=\"text\" id=\"email\" name=\"email\" value=\"".$usuario->getEmail()."\" placeholder=\"Insira seu e-mail aqui\">                            
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Senha:
                            <br><input type=\"password\" id=\"senha\" name=\"senha\" value=\"".$usuario->getSenha()."\" placeholder=\"Insira sua senha aqui\">                            
                        </p>                        
                        <p class=\"title1 whiteTitle\">
                            Descrição:
                            <br><textarea id=\"descricao\" name=\"descricao\" placeholder=\"Insira aqui uma breve descrição sua\">".$usuario->getDescricao()."</textarea>                            
                        </p>
                        <p>
                            <input type=\"button\" value=\"Atualizar dados de usuário\" onclick=\"updateUser('userForm')\">
                        </p>                        
                        <input type=\"hidden\" id=\"senhaAntiga\" name=\"senhaAntiga\" value=\"".$usuario->getSenha()."\">
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"update\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}