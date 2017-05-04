<?php

/* Interface criada para definir uma comparacao entre objetos.
 * 
 * Marcelo Barbosa,
 * novembro, 2015.
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Generic\Generic;

// declaracao da interface
interface iComparison 
{
    // assinatura dos metodos
    public function equals(Generic $obj);    
}
