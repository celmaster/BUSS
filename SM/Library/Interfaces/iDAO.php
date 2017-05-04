<?php

/* Interface da classe abstrata DAO 
 * 
 * Marcelo Barbosa.
 * junho, 2014.
 */

// declaracao do namespace
namespace SM\Library\Interfaces;

// importacao de classes
use SM\Library\Database\Context\Context; 

// declaracao da interface
interface iDAO
{
    
    public function insert(IContextObject $contextObj);
    public function remove($condition, Context $context);    
    public function select(Context $context, $condition, $order, $index, $registersPerPage);
    public function getQuantityOfRegisters();
    public function getQuantityRegistered($field, $condition, Context $context);
    public function getSum($field);
    public function getSumByCondition($field, $condition, Context $context);
    public function exists($condition, Context $context);
    public function cleanTable();
    public function removeObject(IContextObject $obj);
    public function updateObject(IContextObject $obj, IContextObject $oldObj);    
    public function getObjectByCondition($condition, Context $context);    
    public function getFirst();
    public function getPrior();
    public function getNext();
    public function getLast();
    public function getList(Context $context, $condition, $order, $index, $registersPerPage);    
    public function hasObjectByKeyFields(IContextObject $obj);
    public function hasObject(IContextObject $obj);
}
