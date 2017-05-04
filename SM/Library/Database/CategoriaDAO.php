<?php

/* DAO criado para gerenciar a entidade "categoria"
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// declaracao do namespace
namespace SM\Library\Database;

// importacao de classes
use SM\Configuration\DbConfiguration;
use SM\Library\Model\Categoria;

// declaracao de classe
class CategoriaDAO extends DAO
{
    // declaracao de metodos   
    public function __construct()
    {
        // metodo construtor
        $model = new Categoria();
        parent::__construct(DbConfiguration::getBUSSConfiguration(),"categoria", $model->getContext(), 0, "nome");
    }
    
    protected function getObject($data)
    {
        // instancia um objeto referente de uma entidade
        // declaracao de variaveis
        $obj = null;
        
        // tenta instanciar o objeto via resultado obtido do SQL
        try 
        {
            $obj = new Categoria($data["nome"]);
        }catch(Exception $e) 
             {
                 echo "Error: " . $e->getMessage();
             }
        
        // retorno de valor
        return $obj;
    }

}