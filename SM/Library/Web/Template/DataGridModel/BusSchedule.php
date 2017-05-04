<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 11/09/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;
use SM\Library\Collection\ArrayList;
use SM\Library\Utils\TimeStamp;

// declaracao da classe
class BusSchedule extends DataGrid
{
    // declaracao de metodos
    public function __construct(ArrayList $list) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($list);
    }
    
    public function gridModeling(ArrayList $list)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "<table class=\"simpleTable\">						   
                            <tr class=\"tLine\">
                                <td class=\"thead2\">
                                    Linha
                                </td> 
                                <td class=\"thead2\">
                                    Origem / Destino
                                </td> 
                                <td class=\"thead2\">
                                    Horário de partida:
                                </td>
                                <td class=\"thead2\">
                                    Tempo restante:
                                </td>                                                               
                            </tr>                            
                            ".$this->getLines($list)."
                        </table>
                        ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
    
    private function getLines(ArrayList $list)
    {
        // obtem as linhas dos onibus
        // declaracao de variaveis
        $lines = "";
        $timestamp = new TimeStamp();
        $timestamp->setTimeFormat("H:i");
        
        if($list->getSize() == 0)
        {
            $lines = "<tr><td colspan=\"3\">Não há linhas de ônibus nesse momento</td></tr>";
        }
        
        for($i = 0; $i < $list->getSize(); $i++)
        {
            $line = $list->get($i)->getObject();
            $lines .= "     <tr>
                                <td>
                                    ".$line->getId()."
                                </td> 
                                <td>
                                    ".$line->getOrigem()." / ".$line->getDestino()."
                                </td> 
                                <td>
                                    ".$timestamp->getTimeBySeconds($line->getHorarioDeIda())."
                                </td>                                  
                                <td>
                                    <span class=\"timeBus\" id=\"timer".$i."\"></span>
                                    <input type=\"hidden\" id=\"timestamp".$i."\" value=\"".$line->getHorarioDeIda()."\">
                                </td>                                
                            </tr>";
        }
        
        // retorno de valor
        return $lines;
    }
}