<?php

/* DAO criado para gerenciar a entidade "noticia"
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// declaracao do namespace
namespace SM\Library\Database;

// importacao de classes
use SM\Configuration\DbConfiguration;
use SM\Library\Model\Noticia;

// declaracao de classe
class NoticiaDAO extends DAO
{
    // declaracao de metodos   
    public function __construct()
    {
        // metodo construtor
        $model = new Noticia();
        parent::__construct(DbConfiguration::getBUSSConfiguration(),"noticia", $model->getContext(), 0, "dataDaPostagem, horaDaPostagem DESC");
    }
    
    protected function getObject($data)
    {
        // instancia um objeto referente de uma entidade
        // declaracao de variaveis
        $obj = null;
        
        // tenta instanciar o objeto via resultado obtido do SQL
        try 
        {
            $obj = new Noticia($data["titulo"], 
                               $data["dataDaPostagem"], 
                               $data["horaDaPostagem"], 
                               $data["categoria"], 
                               $data["emailDoAutor"], 
                               $data["texto"], 
                               $data["ilustracao"],
                               $data["id"]);
        }catch(Exception $e) 
             {
                 echo "Error: " . $e->getMessage();
             }
        
        // retorno de valor
        return $obj;
    }

}
