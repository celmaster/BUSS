<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 09/10/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;
use SM\Library\Model\Linha;
use SM\Configuration\SystemConfiguration;
use SM\Library\Utils\TimeStamp;
use SM\Library\Utils\StringManager;

// declaracao da classe
class LineUpdateForm extends DataGrid
{
    // declaracao de metodos
    public function __construct(Linha $linha) 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling($linha);
    }
    
    public function gridModeling(Linha $linha)
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $timestamp = new TimeStamp();
        $horarioDeIda = $timestamp->getTimeBySeconds($linha->getHorarioDeIda());
        $horarioDeVolta = $timestamp->getTimeBySeconds($linha->getHorarioDeVolta());        
        $model = "
                    
                    <form class=\"formStyle1\" id=\"lineForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/LinhaController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Identificador da linha do ônibus:
                            <br><input type=\"text\" id=\"id\" name=\"id\" value=\"".$linha->getId()."\" placeholder=\"Insira o identificador da linha do ônibus aqui\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Horário de partida do ônibus:
                            <br><input type=\"text\" id=\"horarioDeIda\" value=\"".$horarioDeIda."\" name=\"horarioDeIda\" onkeypress=\"createMask('horarioDeIda', 'xx:xx:xx')\" placeholder=\"Insira o horário de ida do ônibus aqui\" maxlength=\"8\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Horário de volta do ônibus:
                            <br><input type=\"text\" id=\"horarioDeVolta\" value=\"".$horarioDeVolta."\" name=\"horarioDeVolta\" onkeypress=\"createMask('horarioDeVolta', 'xx:xx:xx')\" placeholder=\"Insira o horário de volta do ônibus aqui\" maxlength=\"8\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Dia da semana:
                            <br>".$this->getDayList($linha->getDiaDaSemana())."
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Origem da linha do ônibus:
                            <br><input type=\"text\" id=\"origem\" value=\"".$linha->getOrigem()."\" name=\"origem\" placeholder=\"Informe a origem da linha do ônibus\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Destino da linha do ônibus:
                            <br><input type=\"text\" id=\"destino\" value=\"".$linha->getDestino()."\" name=\"destino\" placeholder=\"Informe o destino da linha do ônibus\">
                        </p>
                        <p>
                            <input type=\"button\" value=\"Atualizar\" onclick=\"processLine('lineForm')\">
                        </p>
                        <p>
                            <input type=\"button\" class=\"backButton\" value=\"Voltar para a tela de gerenciamento\" onclick=\"navPage('gerenciarLinhas.php')\">
                        </p>
                        <input type=\"hidden\" name=\"idAntigo\" value=\"".$linha->getId()."\">
                        <input type=\"hidden\" name=\"horarioDeIdaAntigo\" value=\"".$horarioDeIda."\">
                        <input type=\"hidden\" name=\"horarioDeVoltaAntigo\" value=\"".$horarioDeVolta."\">
                        <input type=\"hidden\" name=\"diaDaSemanaAntigo\" value=\"".$linha->getDiaDaSemana()."\">
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"update\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
    
    private function getDayList($day)
    {
        // obtem a lista de dias das linhas de onibus
        // declaracao de variaveis
        $list = "<select id=\"diaDaSemana\" name=\"diaDaSemana\" size=\"1\">
                                <option value=\"#\">Selecione</option>";
        $days = array("Sunday" => "domingo", 
                      "Monday" => "segunda-feira",
                      "Tuesday" => "terça-feira",
                      "Wednesday" => "quarta-feira",
                      "Thursday" => "quinta-feira",
                      "Friday" => "sexta-feira",
                      "Saturday" => "sábado",
                      "WorkingDays" => "todos os dias úteis");
        
        foreach($days as $key => $value)
        {
            if(StringManager::equalsIgnoreCase($key, $day))
            {
                $list .= "<option value=\"".$key."\" selected>".$value."</option>";
            }else
                {
                    $list .= "<option value=\"".$key."\">".$value."</option>";
                }
        }
        
        $list .= "</select>";
        
        //retorno de valor
        return $list;
        
    }
}