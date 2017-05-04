<?php
/*
 * Classe criada para gerar uma fila dinamica de elementos.
 * 
 * Marcelo Barbosa.
 * dezembro, 2013.
*/

// declaracao do namespace
namespace SM\Library\Collection;

// importacao de classes
use SM\Library\Generic\Generic;
use SM\Library\Utils\Collection;
use SM\Library\Interfaces\iQueue;

// declaração de classes
class Queue extends Generic implements iQueue
{
    // declaração de atributos
    private $begin;
    private $end;
    private $size;
    private $index;
    
    // declaração de métodos        
    public function __construct($objectName = "Queue") 
    {
        // método construtor
        // inicializacao de atributos
        parent::__construct($objectName);
        
        $this->size = 0;
        $this->index = 0;
        $this->begin = null;        
        $this->end = $this->begin;
    }
    
    public function setIndex($index)
    {
        $this->index = $index;
    }
    
    public function getIndex()
    {
        return $this->index;
    }
    
    public function add($object)
    {
        // insere um elemento na fila        
        $this->insert($object, $this->getIndex());
        $this->setIndex($this->getIndex() + 1);
    }

    public function insert($object, $keyValue) 
    {
        // insere um elemento na fila
        
        // verifica se a fila esta vazia
        if($this->isEmpty())
        {
            // insere o elemento no inicio da fila
            $this->begin = new Node();
            $this->begin->setKey($keyValue);
            $this->begin->setObject($object);
            $this->begin->setNext(null);
            $this->begin->setPrior(null);
            $this->end = $this->begin;
        }else 
            {
                // cria um novo no e insere ele no final da fila
                $node = new Node();
                $node->setObject($object);
                $node->setKey($keyValue);

                $node->setPrior($this->end);
                $this->end->setNext($node);
                $this->end = $node;
            }
            
        // incrementa o contador    
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
        
        // verifica se a fila nao esta vazia        
        if(!$this->isEmpty())
        {
            // verifica se esta no inicio da fila  
            $queue = $this->begin;
            $value = $this->getNodePropertyValue($queue, $typeSearch);
            
            if($this->compare($search, $value))
            {
                $node = $queue;
            }
            
            // verifica se esta no meio ou no fim da fila
            if($node == null)
            {
                $queue = $queue->getNext();
                
                while($queue != null)
                {
                    $value = $this->getNodePropertyValue($queue, $typeSearch);
                    if($this->compare($search, $value))
                    {
                        $node = $queue;
                        break;
                    }
                    
                    $queue = $queue->getNext();
                }
            }
            
        }
        
        // retorno de valor
        return $node;
    }

    public function destroy() 
    {
        // destroi todos os elementos da fila
        do
        {
            $status = $this->remove();
        }while($status);
        
    }
    
    public function setSize($size) 
    {
        $this->size = $size;
    }

    public function getSize() 
    {
        return $this->size;
    }

    public function isEmpty() 
    {
        // verifica se a fila esta vazia
        $status = false;
        
        if($this->begin == null)
        {
            $status = true;
        }
        
        // retorno de valor
        return $status;
    }    

    public function select() 
    {
        // seleciona todos os elementos da fila
        if(!$this->isEmpty())
        {
            
            // declaracao de variaveis
            $node = $this->begin;
            
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
                echo "<br>Can't select objects! Queue is empty!<br>";                
            }
    }

    public function get($index = 0)
    {
        // obtem um objeto por seu indice
        // declaracao de variaveis
        $obj = null;
        
        // verifica se a fila nao esta vazia
        if(!$this->isEmpty())
        {
            if($index < $this->getSize())
            {
                // cria uma variavel de controle para o laco de repeticao
                $pointer = 0;
                $obj = $this->begin;

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
        
        //retorno de valor
        return $obj->getKey();
    }

    public function remove() 
    {
        // remove o primeiro elemento da fila através da caracteristica FIFO
        // declaracao de variaveis            
        $status = false;
        
        // verifica se a fila possui elementos        
        if(!$this->isEmpty())
        {
        
            $next = $this->begin->getNext();
            if($next == null)
            {
                Collection::removeNode($this->begin);
                $this->begin = null;
                $this->end = $this->begin;
            }else
                {
                    $prior = $this->begin->getPrior();
                    $next->setPrior($prior);                    
                    Collection::removeNode($this->begin);
                    $this->begin = $next;
                }
            
            // decrementa o numero de elementos da fila
            $this->setSize($this->getSize() - 1);
            
            // altera o valor da variavel logica
            $status = true;
        }
        
        // retorno de valor
        return $status;
    }

    public function toArray() 
    {
        // retorna um array com todos os elementos da estrutura de dados
        // declaracao de variaveis        
        $array = null;
        
        // verifica se a fila esta vazia
        if(!$this->isEmpty())
        {
            // pega o primeiro elemento da fila
            $element = $this->begin;
            
            while($element != null)
            {
                $queueToArray[] = $element;
                $element = $element->getNext();
            }
            
            
            $array = $queueToArray;
        }
        
        
        // retorno de valor
        return $array;
    }

    public function toString()
    {
        // retorna todo o conteudo da fila para uma string
        // declaracao de variaveis
        $stringValue = "";          

        // verificando se a fila possui objetos            
        if(!$this->isEmpty())
        {   
            // pegando o primeiro no da fila
            $node = $this->begin;

            // percorrendo os dados da fila
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
                . "<br>Size: &nbsp;<b>".$this->getSize()."</b> object(s) in Queue<br>";    

        // retorno de valor
        return $stringValue; 
    }

    public function update(Node $object)
    {
        // atualiza um objeto dado o valor de sua chave
        // declaracao de variaveis
        $status = false;
        
        //verificando se a fila nao esta vazia
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

}