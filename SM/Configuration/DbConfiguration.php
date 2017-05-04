<?php

/* Classe criada para armazenar as configuracoes de conexao com um banco de dados
 * 
 * Marcelo Barbosa,
 * junho, 2015.
 */

// declaracao do namespace
namespace SM\Configuration;

// importacao de classes
use SM\Library\Model\Configuration;
use SM\Library\Utils\Tools\DatabaseTool;
use SM\Library\IO\File\File;
use SM\Library\Database\SMUserDAO;
use SM\Library\IO\Session;

// declaracao da classe
class DbConfiguration
{
    // declaracao de atributos
    const username = "root";
    const password = "root";
    const servername = "localhost";
    const databasename = "smDB";
    const driver = "mysql";
    const cryptKey = "JLKA1HT53X0%YQW&";
    const cipherAlgorithm = null;
    const decipherAlgorithm = null;
    const locale = "Brazil/East";        
            
    // declaracao de metodos
    public static function getDefaultConfiguration()
    {
        return new Configuration(DbConfiguration::driver,             // driver 
                                 DbConfiguration::databasename,       // database
                                 DbConfiguration::servername,         // servername
                                 DbConfiguration::username,           // username
                                 DbConfiguration::password,           // password
                                 DbConfiguration::cryptKey,           // crypt key 
                                 DbConfiguration::cipherAlgorithm,    // cipher algorithm 
                                 DbConfiguration::decipherAlgorithm,  // decipher algorithm 
                                 DbConfiguration::locale);            // locale
    }
    
    public static function getMinDefaultConfiguration()
    {
        return new Configuration(DbConfiguration::driver,             // driver 
                                 "",                                  // database
                                 DbConfiguration::servername,         // servername
                                 DbConfiguration::username,           // username
                                 DbConfiguration::password,           // password
                                 DbConfiguration::cryptKey,           // crypt key
                                 DbConfiguration::cipherAlgorithm,    // cipher algorithm 
                                 DbConfiguration::decipherAlgorithm,  // decipher algorithm 
                                 DbConfiguration::locale);            // locale
    }
    
    public static function getBUSSConfiguration()
    {
        return new Configuration(DbConfiguration::driver,             // driver 
                                 "bussDb",                            // database
                                 DbConfiguration::servername,         // servername
                                 DbConfiguration::username,           // username
                                 DbConfiguration::password,           // password
                                 "ASD1RE4ZF419@A2R3WE#$$*2X^Y",       // crypt key 
                                 DbConfiguration::cipherAlgorithm,    // cipher algorithm 
                                 DbConfiguration::decipherAlgorithm,  // decipher algorithm 
                                 DbConfiguration::locale);            // locale
    }
    
    public static function getMinBUSSConfiguration()
    {
        return new Configuration(DbConfiguration::driver,             // driver 
                                 "",                                  // database
                                 DbConfiguration::servername,         // servername
                                 DbConfiguration::username,           // username
                                 DbConfiguration::password,           // password
                                 "ASD1RE4ZF419@A2R3WE#$$*2X^Y",       // crypt key 
                                 DbConfiguration::cipherAlgorithm,    // cipher algorithm 
                                 DbConfiguration::decipherAlgorithm,  // decipher algorithm 
                                 DbConfiguration::locale);            // locale
    }
    
    public static function initDbSystem()
    {
        // inicializa a configuracao padrao do sistema
        // declaracao de variaveis
        $file = new File(SystemConfiguration::getRoot()."Assets/Scripts/SM/SQL/", "smScript.sql");
        $sql = "";
        $status = false;
        
        if($file->exist())
        {
            $sql = $file->read();
            $status = DatabaseTool::exec($sql, DbConfiguration::getMinDefaultConfiguration());
        }
        
        // returno de valor
        return $status;
    }
    
    public static function initBUSSDbSystem()
    {
        // inicializa a configuracao padrao do sistema
        // declaracao de variaveis
        $file = new File(SystemConfiguration::getRoot()."Assets/Scripts/SQL/", "bussdb.sql");
        $sql = "";
        $status = false;
        
        if($file->exist())
        {
            $sql = $file->read();
            $status = DatabaseTool::exec($sql, DbConfiguration::getMinBUSSConfiguration());
        }
        
        // returno de valor
        return $status;
    }
    
    public static function hasDataSystem()
    {
        // cria o banco de dados caso ele nao exista
        if(!DatabaseTool::hasDatabase(DbConfiguration::databasename,  DbConfiguration::getMinDefaultConfiguration()))
        {
            DbConfiguration::initDbSystem();
        }
    }
    
    public static function hasBUSSDataSystem()
    {
        // cria o banco de dados caso ele nao exista
        if(!DatabaseTool::hasDatabase("bussdb",  DbConfiguration::getMinBUSSConfiguration()))
        {
            DbConfiguration::initBUSSDbSystem();
        }
    }
    
    public static function hasUser()
    {
        // verifica se o sistema ja possui usuario cadastrado
        // declaracao de variaveis
        $dao = new SMUserDAO();
        $status = false;
        
        if($dao->getQuantityOfRegisters() > 0)
        {
            $status = true;
        }
        
        // retorno de valor
        return $status;
    }
    
    public static function hasUserSession()
    {
        // verifica se um usuario possui sessao aberta
        // declaracao de variaveis
        $username = Session::get("username");
        $statement = $username != null;
        
        // retorno de valor
        return $statement;
    }
    
    public static function hasSession($sessioName)
    {
        // verifica se uma sessao esta ativa
        // declaracao de variaveis
        $username = Session::get($sessioName);
        $statement = $username != null;
        
        // retorno de valor
        return $statement;
    }
}