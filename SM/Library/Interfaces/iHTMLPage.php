<?php

/* Interface de um script para documentos html
 *  
 * Marcelo Barbosa,
 * outubro, 2015.
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Web\CSSFileScript;
use SM\Library\Web\JSFileScript;

// declaracao da interface
interface iHTMLPage 
{
   // assinatura dos metodos
   public function addAuthor($name);
   public function addCSSScript(CSSFileScript $css);
   public function addJSScript(JSFileScript $js);
   public function cleanAuthors();
   public function cleanKeyWords();
   public function cleanCSSScripts();
   public function cleanJSScripts();
   public function cleanScripts();
   public function getAllCSSScripts();
   public function getAllJSScripts();   
   public function addContent($content);
   public function addHeadContent();
   public function addKeyWord($keyword);
   public function addKeyWords(array $array);
}