<?php

/* DAO criado para gerenciar a entidade "usuario"
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// declaracao do namespace
namespace SM\Library\Database;

// importacao de classes
use SM\Configuration\DbConfiguration;
use SM\Library\Model\Usuario;
use SM\Library\Utils\ProcessContext;

// declaracao de classe
class UsuarioDAO extends DAO
{
    // declaracao de metodos   
    public function __construct()
    {
        // metodo construtor
        $model = new Usuario();
        parent::__construct(DbConfiguration::getBUSSConfiguration(),"usuario", $model->getContext(), 0, "email");
    }
    
    protected function getObject($data)
    {
        // instancia um objeto referente de uma entidade
        // declaracao de variaveis
        $obj = null;
        
        // tenta instanciar o objeto via resultado obtido do SQL
        try 
        {
            $obj = new Usuario($data["email"], 
                               $data[ProcessContext::decipher("senha")],
                               $data["nome"],
                               $data["sobrenome"],
                               $data["descricao"]);
        }catch(Exception $e) 
             {
                 echo "Error: " . $e->getMessage();
             }
        
        // retorno de valor
        return $obj;
    }

}
