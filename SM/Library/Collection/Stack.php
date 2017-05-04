<?php
/*Classe criada para gerir as funcionalidades de uma estrutura de dados do tipo pilha
 * 
 * Marcelo Barbosa.
 * dezembro, 2013.
 */

// declaracao do namespace
namespace SM\Library\Collection;

// importacao de classes
use SM\Library\Generic\Generic;
use SM\Library\Utils\Collection;
use SM\Library\Interfaces\iStack;
    
// declaração de classes
class Stack extends Generic implements iStack
{
    // declaração de atributos
    private $top;
    private $size;
    private $index;
    
    // declaração de métodos
    public function __construct($objectName = "Stack")
    {     
        // método construtor
        // inicializacao dos atributos
        parent::__construct($objectName);
        
        $this->index = 0;
        $this->size = 0;
        $this->top = null;        
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
    
    public function getSize() 
    {
        return $this->size;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    }        
    
    // métodos de aplicação
    public function isEmpty()
    {
        // retorna verdadeiro ao falso caso a pilha esteja vazia
        if($this->top == null)
        {
            return true;
        }else
            {
                return false;
            }
    }
    
    public function add($object)
    {
        // insere um elemento na pilha        
        $this->push($object, $this->getIndex());
        $this->setIndex($this->getIndex() + 1);
    }
    
    public function push($object, $keyValue)
    {
        // insere um elemento na pilha
        // declaração de variáveis
        $node = new Node($keyValue);
        $node->setKey($keyValue);
        $node->setObject($object);
        
        // adicionando o elemento na pilha        
        $node->setNext($this->top);
        if($this->top != null)
        {
            $this->top->setPrior($node);
        }
        
        $this->top = $node;        
            
        // incrementando o contador
        $this->setSize($this->getSize() + 1);
    }
    
    public function pop()
    {
        // remove o elemento do topo da pilha
        // declaração de variáveis        
        $next = $this->top->getNext();
        $status = false;
        
        // verifica se a pilha esta vazia         
        if(!$this->isEmpty())
        {   
            //  removendo o elemento do topo
            Collection::removeNode($this->top);
            
            /* caso nao haja proximos elementos na pilha, significa que ela 
             * estara vazia apos a remocao do no atual.
             */ 
            if(isset($next))
            {    
                // pegando o próximo nó
                $this->top = $next;
            }else
                {
                    $this->top = null;
                }
                
            // altera o valor da variavel logica
            $status = true;
                
            // decrementando o contador
            $this->setSize($this->getSize() - 1);
        }
        
        // retorno de valor 
        return $status;
    }

    public function destroy() 
    {
        // remove todos os dados da pilha   
        // verificando se a pilha não está vazia
        if(!$this->isEmpty())
        {    
            do
            {
                $this->pop();
            }while(!$this->isEmpty());
        }else
            {
                echo "<br>Can't destroy Stack! Stack is empty!</br>";
            }
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
        
        // verifica se a pilha nao esta vazia        
        if(!$this->isEmpty())
        {
            // verifica se esta no inicio da pilha  
            $list = $this->top;
            $value = $this->getNodePropertyValue($list, $typeSearch);
            
            if($this->compare($search, $value))
            {
                $node = $list;
            }
            
            // verifica se esta no meio ou no fim da pilha
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
    
    public function get($index)
    {
        // obtem um objeto por seu indice
        // declaracao de variaveis
        $obj = null;

        // verifica se a pilha nao esta vazia
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
        
        //retorno de valor
        return $obj->getKey();
    }

    public function select() 
    {
        // seleciona todos os objetos da estrutura

        // verificando se a estrutura esta vazia
        if(!$this->isEmpty())
        {
            // declaracao de variaveis
            $node = $this->top;
            
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

    public function update(Node $object) 
    {
        // atualiza um objeto dado o valor de sua chave
        // declaracao de variaveis
        $status = false;
        
        //verificando se a pilha nao esta vazia
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
        // retorna o conteudo da pilha em uma string
        // declaracao de variaveis
        $stringValue = "";          

        // verificando se a pilha possui objetos            
        if(!$this->isEmpty())
        {   
            // pega o topo da pilha
            $node = $this->top;

            // percorrendo os dados da pilha
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
                . "<br>Size: &nbsp;<b>".$this->getSize()."</b> object(s) in Stack<br>";    

        // retorno de valor
        return $stringValue;  
    }

    public function toArray()
    {
        // retorna um array com todos os elementos da estrutura de dados
        // declaração de variáveis        
        $array = null;
        
        // verifica se a pilha está vazia
        if(!$this->isEmpty())
        {
            // pega o topo da pilha
            $element = $this->top;
            
            while($element != null)
            {
                $stackList[] = $element;
                $element = $element->getNext();
            }
            
            
            $array = $stackList;
        }
        
        // retorno de valor
        return $array;
    }

}