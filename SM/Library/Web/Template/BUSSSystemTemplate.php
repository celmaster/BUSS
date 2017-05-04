<?php
/* Template gerado dinamicamente com SM.
 * 
 * Marcelo Barbosa,
 * 14/09/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template;

// importacao de classes
use SM\Library\Web\HTMLPage;
use SM\Configuration\SystemConfiguration;
use SM\Library\Web\CSSFileScript;
use SM\Library\Web\JSFileScript;

// declaracao da classe
class BUSSSystemTemplate extends HTMLPage
{
    // declaracao de metodos
    public function __construct($title = "HTML document", $chaset = "utf-8") 
    {
        // metodo construtor
        // inicializa a superclasse
        parent::__construct($title, $chaset);

        // inicializa scripts
        $this->initScripts();

        // configura o corpo do documento web
        $this->setBody("\n<body>\n"
                        ."<!-- @Structure -->
        <div class=\"scenery\" id=\"scenery\">
            <div class=\"header\">
                <!-- @Header -->
                
                
            </div>            
            <div class=\"content\">
                <!-- @Content -->
                
                <div>
                </div>
            </div>			
        </div>
        "
                   ."\n</body>\n");
    }

    public function initScripts()
    {
        // inicializa as listas de scripts
        // adiciona arquivos de script CSS e JS
        $this->addCSSScript(new CSSFileScript(SystemConfiguration::getCSSDir(), "systemStyle.css"));
$this->addJSScript(new JSFileScript(SystemConfiguration::getJSDir(), "systemLibrary.js"));

    }
}