<?php

/* 
 * Interface responsavel por uma assinatura generica de todos os metodos à serem utilizados uma estrutura de dados
 * 
 * 
 * Observacoes: Esta interface pode implementar estruturas do tipo Lista (ArrayList, CircleList) e arvore (BalancedBinarySearchTree/AVL). 
 *  
 * Marcelo Barbosa.
 * dezembro, 2013. 
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Collection\Node;

//declaracao da interface
interface iCollection
{
    // declaracao dos metodos
    public function isEmpty();
    public function insert($object, $key);
    public function removeFirstObject();   
    public function remove($key);
    public function removeObject(Node $object);
    public function select();    
    public function get($index);
    public function getByKey($key);
    public function getKeyOf($obj);
    public function update(Node $object);
    public function getSize();
    public function destroy();
    public function toArray();    
}