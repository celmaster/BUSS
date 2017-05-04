<?php
/*
 * Classe criada para gerar uma lista dinamica de elementos em um array
 * 
 * Marcelo Barbosa.
 * dezembro, 2013.
 */

// declaracao do namespace
namespace SM\Library\Collection;

// importacao de classes
use SM\Library\Generic\Generic;
use SM\Library\Utils\Collection;
use SM\Library\Interfaces\iCollection;

// declaração da classe
class ArrayList extends Generic implements iCollection
{
    // declaracao de atributos        
    private $head;                  // inicio da lista        
    private $size;                  // quatidade de elementos da lista
    private $index;                 // indice com auto incremento

    // declaracao de metodos
    public function __construct($objectName = "ArrayList")
    {
        // metodo construtor
        // inicializacao de atributos
        parent::__construct($objectName);
        
        $this->index = 0;
        $this->size = 0;                  
        $this->head = null;         
    } 

    // metodos de encapsulamento
    public function setIndex($index)
    {
        $this->index = $index;
    }
    
    public function getIndex()
    {
        return $this->index;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    } 

    public function getSize()
    {
        return $this->size;
    }                

    // metodos de aplicacao        
    public function isEmpty()
    {
        // retorna verdadeiro ou falso, caso a lista esteja vazia
        if($this->head == null)
        {
            return true;
        }else
            {
                return false;
            }
    }

    public function add($object)
    {
        // insere um elemento na lista        
        $this->insert($object, $this->getIndex());
        $this->setIndex($this->getIndex() + 1);
    }

    public function insert($object, $key)
    {
        // insere um objeto na estrutura de dados            
        // declaracao de variaveis
        $status = false;
        $node = new Node($key);
        $node->setKey($key);
        $node->setObject($object);

        // verificando se a estrutura esta vazia
        if($this->isEmpty())
        { 
            // insere o elemento no inicio da estrutura
            $this->head = $node;
            
            // altera o valor da variavel logica
            $status = true; 
        }else
            {
                // verificando se o objeto pode ser inserido no inicio da lista ou meio
                $list = &$this->head;
                while(($list != null) && (!$status))
                {
                     // pegando o elemento anterior
                    $prior = $list->getPrior();
                    
                    if($node->getKey() <= $list->getKey())
                    {  
                        if($prior != null)
                        {   
                            $prior->setNext($node);                            
                        }                                                
                        
                        $node->setNext($list);
                        $node->setPrior($prior);
                        $list->setPrior($node);
                        $list = $node;

                        // altera o valor da variavel logica
                        $status = true; 
                        break;
                    }else
                        {
                            if($list->getNext() == null)
                            {
                                $node->setPrior($list);
                                $node->setNext(null);
                                $list->setNext($node);
                                $list = &$node;
                            }
                        }
                    
                    $obj = $list->getNext();
                    $list = &$obj;
                }
            }
            
        // incrementando o contador
        $this->setSize($this->getSize() + 1);

    } 
    
    private function compare($value1, $value2)
    {
        // compara o valor de dois objetos
        // declaracao de variaveis
        $status = false;
        
        if(!is_object($value1) && !is_object($value2))
        {
            if($value1 == $value2)
            {
                $status = true;
            }
        }else
            {
                if(($value1 instanceof iComparison) &&
                   ($value2 instanceof iComparison))
                {
                    $status = $value1->equals($value2);
                }
            }
        
        // retorno de valor
        return $status;
    }
    
    private function getNodePropertyValue(Node $node, $type)
    {
        // recupera o valor de uma propriedade de um no
        // declaracao de variaveis
        $value = null;
        if($type == 1)
        {
            $value = $node->getObject();
        }else
            {
                $value = $node->getKey();
            }
            
        // retorno de valor    
        return $value;
    }
    
    private function getNode($search, $typeSearch = 1)
    {
        // recupera um no atraves de seu valor (1) ou chave (2)        
        // declaracao de variaveis
        $node = null;
        
        // verifica se a lista nao esta vazia        
        if(!$this->isEmpty())
        {
            // verifica se esta no inicio da lista  
            $list = $this->head;
            $value = $this->getNodePropertyValue($list, $typeSearch);
            
            if($this->compare($search, $value))
            {
                $node = $list;
            }
            
            // verifica se esta no meio ou no fim da lista
            if($node == null)
            {
                $list = $list->getNext();
                
                while($list != null)
                {
                    $value = $this->getNodePropertyValue($list, $typeSearch);
                    if($this->compare($search, $value))
                    {
                        $node = $list;
                        break;
                    }
                    
                    $list = $list->getNext();
                }
            }
            
        }
        
        // retorno de valor
        return $node;
    }

    public function removeFirstObject()
    {
        // remove o primeiro objeto da lista 
        // declaracao de variaveis
        $node;
        $next;

        // verificando se a lista esta vazia
        if(!$this->isEmpty())
        {
            // pegando o elemento a ser removido
            $node = &$this->head;

            // pegando o proximo no
            $next = $node->getNext();

            // verificando se o proximo no e vazio
            if($next != null)
            {    
                $this->head = $next;

                // deletando o elemento
                Collection::removeNode($node); 
            }else
                {
                    unset($this->head);

                    // pegando um novo bloco de memoria
                    $this->head = new Node();
                }

            // decrementando o contador
            $this->setSize($this->getSize() - 1);

        }else
            {     
                echo "<br>Can't delete object! ArrayList is empty!<br>";

            }
    }

    public function remove($key)
    {
        // remove um elemento pela sua chave
        // declaracao de variaveis
        $status = false;
        
        // verificando se a lista esta vazia
        if(!$this->isEmpty())
        {
            // o elemento a ser removido esta no primeiro no da lista
            if($this->compare($key, $this->head->getKey()))
            {
                $this->removeFirstObject();
                
                // altera o valor da variavel logica
                $status = true;
            }else
                {
                    // o elemento a ser removido esta no meio ou final da lista
                    $obj = $this->getNode($key, 2);            

                    if($obj != null)
                    {                
                        // ajusta os ponteiros
                        $node = &$obj;
                        $prior = $node->getPrior();
                        $next = $node->getNext();
                        $prior->setNext($next);

                        if($next != null)
                        {
                            $next->setPrior($prior);
                        }

                        // remove o elemento
                        Collection::removeNode($node);

                        // decrementa o numero de elementos da lista
                        $this->setSize($this->getSize() - 1);

                         // altera o valor da variavel logica
                         $status = true;
                    }
                }            
        }
            
        // retorno de valor
        return $status;
    }    

    public function removeObject(Node $object)
    {
        // remove um objeto por comparacao de enderecos
        // declaracao de variaveis
        $status = $this->remove($object->getKey());
        
        // retorno de valor
        return $status;
    }

    public function destroy()
    {
        // destroy toda a lista apagando todos os elementos

        // verificando se ha elementos na lista
        if(!$this->isEmpty())
        {
            // utlizando o loop condicional para remover o elemento inicial modo que o proximo elemento seja o alvo para remocao
            do
            {
                $this->removeFirstObject();
            }while($this->head->getObject() != null);    

        }else
            {
                echo "<br>Can't destroy ArrayList! ArrayList is empty!<br>";
            }

    }

    public function select()
    {
        // seleciona todos os objetos da estrutura

        // verificando se a estrutura esta vazia
        if(!$this->isEmpty())
        {
            // declaracao de variaveis
            $node = $this->head;
            
            while($node != null)
            {
               if(is_object($node->getObject()))
               {
                   Collection::printObjectToValueOfObject($node->getObject());
               }else
                   {
                        echo $node->getObject()."<br>";
                   }
                $node = $node->getNext();
            }
        }else
            {                    
               echo "<br>Can't select objects! ArrayList is empty!<br>";               
            }
    }
    
    public function get($index = 0)
    {
        // obtem um objeto por seu indice
        // declaracao de variaveis
        $obj = null;

        // verifica se a lista nao esta vazia
        if(!$this->isEmpty())
        {
            if($index < $this->getSize())
            {
                // cria uma variavel de controle para o laco de repeticao
                $pointer = 0;
                $obj = $this->head;

                while(($obj != null) && ($pointer < $index))
                {
                    $obj = $obj->getNext();                        
                    $pointer++;
                }
            }

        }

        // retorno de valor
        return $obj;

    }

    public function getByKey($key)
    {
        // obtem um objecto atraves de sua chave
        // declaracao de variaveis
        $obj = $this->getNode($key, 2);
        
        //retorno de valor
        return $obj->getObject();
    }
    
    public function getKeyOf($obj)
    {
        // obtem um objecto atraves de sua chave
        // declaracao de variaveis
        $obj = $this->getNode($obj);
        $key = null;
        
        if($obj != null)
        {
           $key = $obj->getKey();
        }
        
        //retorno de valor
        return $key;
    }
    
    public function update(Node $object)
    {
        // atualiza um objeto dado o valor de sua chave
        // declaracao de variaveis
        $status = false;
        
        //verificando se a lista nao esta vazia
        if(!$this->isEmpty())
        {
            $key = $object->getKey();            
            $obj = $this->getNode($key, 2);
            
            if($obj != null)
            {
                $node = &$obj;
                $node->setObject($object->getObject());                
                
                // altera o valor da variavel logica
                $status = true;
            }
        }
        
        // retorno de valor
        return $status;
            
    }

    public function toString()
    {
        // passa todo o conteudo da lista para uma string
        // declaracao de variaveis
        $stringValue = "";          

        // verificando se a lista possui objetos            
        if(!$this->isEmpty())
        {   
            // pegando o primeiro no da lista
            $node = $this->head;

            // percorrendo os dados da lista
            do
            {
                // verificando se o valor do objeto e uma instancia
                if(is_object($node->getObject()))
                {
                    $stringValue .= "<br> Object's value: <br>"
                            . "&nbsp;&nbsp;&nbsp;"
                            . "<div style='margin-left:50px; border: 1px solid; border-radius: 3px; padding: 2px;'>"
                            . "<b>". Collection::objectToString($node->getObject())."</b></div><br> Key: &nbsp;<b>".$node->getKey()."</b><br><br>";
                }else 
                    {
                        // gravando os dados na string de retorno
                        $stringValue .= "<br> Object's value: "
                                . "&nbsp;&nbsp;&nbsp;<b>".$node->getObject()
                                ."</b><br> Key: &nbsp;<b>".$node->getKey()."</b><br><br>";
                    }

                // pegando o proximo objeto
                $node = $node->getNext();

            }while(isset($node));

        }else
            {
                $stringValue = "Empty!";
            }

        // inserindo a quantidade de itens na string de retorno
        $stringValue .= "<br><br>"
                . "<hr style='width:100%' noshade size='0.5' color='black'>"
                . "<br>Size: &nbsp;<b>".$this->getSize()."</b> object(s) in ArrayList<br>";    

        // retorno de valor
        return $stringValue;    

    }       
        
    public function toArray() 
    {
        // retorna um array com todos os elementos da estrutura de dados
        // declaracao de variaveis        
        $array = null;
        
        // verifica se a lista esta vazia
        if(!$this->isEmpty())
        {
            // pega o primeiro elemento da lista
            $element = $this->head;
            
            while($element != null)
            {
                $arrayList[] = $element;
                $element = $element->getNext();
            }
            
            $array = $arrayList;
        }
        
        
        // retorno de valor
        return $array;
    }    
        
} 