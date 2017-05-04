<?php

/* DAO criado para gerenciar a entidade "linha"
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// declaracao do namespace
namespace SM\Library\Database;

// importacao de classes
use SM\Configuration\DbConfiguration;
use SM\Library\Model\Linha;

// declaracao de classe
class LinhaDAO extends DAO
{
    // declaracao de metodos   
    public function __construct()
    {
        // metodo construtor
        $model = new Linha();
        parent::__construct(DbConfiguration::getBUSSConfiguration(),"linha", $model->getContext(), 0, "id");
    }
    
    protected function getObject($data)
    {
        // instancia um objeto referente de uma entidade
        // declaracao de variaveis
        $obj = null;
        
        // tenta instanciar o objeto via resultado obtido do SQL
        try 
        {
            $obj = new Linha($data["id"], 
                             $data["horarioIda"], 
                             $data["horarioVolta"], 
                             $data["diaDaSemana"], 
                             $data["origem"], 
                             $data["destino"]);
            
        }catch(Exception $e) 
             {
                 echo "Error: " . $e->getMessage();
             }
        
        // retorno de valor
        return $obj;
    }

}
