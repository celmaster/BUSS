<?php
/* Grid criado automaticamente com SM
 * 
 * Marcelo Barbosa,
 * 14/09/2016.
 */

// declaracao do namespace
namespace SM\Library\Web\Template\DataGridModel;

// importacao de classes
use SM\Library\Web\DataGrid\DataGrid;
use SM\Configuration\SystemConfiguration;

// declaracao da classe
class LineRecordForm extends DataGrid
{
    // declaracao de metodos
    public function __construct() 
    {
        // inicializa a superclasse
        parent::__construct("", "Data Grid");

        $this->gridModeling();
    }
    
    public function gridModeling()
    {
        // modela o conteudo de uma data grid
        // declaracao de variaveis
        $model = "
                    <form class=\"formStyle1\" id=\"lineForm\" action=\"".SystemConfiguration::getURLBase()."Library/Controller/LinhaController.php\" method=\"post\">
                        <p class=\"title1 whiteTitle\">
                            Identificador da linha do ônibus:
                            <br><input type=\"text\" id=\"id\" name=\"id\" placeholder=\"Insira o identificador da linha do ônibus aqui\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Horário de partida do ônibus:
                            <br><input type=\"text\" id=\"horarioDeIda\" name=\"horarioDeIda\" onkeypress=\"createMask('horarioDeIda', 'xx:xx:xx')\" placeholder=\"Insira o horário de ida do ônibus aqui\" maxlength=\"8\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Horário de volta do ônibus:
                            <br><input type=\"text\" id=\"horarioDeVolta\" name=\"horarioDeVolta\" onkeypress=\"createMask('horarioDeVolta', 'xx:xx:xx')\" placeholder=\"Insira o horário de volta do ônibus aqui\" maxlength=\"8\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Dia da semana:
                            <br><select id=\"diaDaSemana\" name=\"diaDaSemana\" size=\"1\">
                                <option value=\"#\">Selecione</option>
                                <option value=\"Sunday\">domingo</option>
                                <option value=\"Monday\">segunda-feira</option>
                                <option value=\"Tuesday\">terça-feira</option>                                
                                <option value=\"Wednesday\">quarta-feira</option>
                                <option value=\"Thursday\">quinta-feira</option>
                                <option value=\"Friday\">sexta-feira</option>
                                <option value=\"Saturday\">sábado</option>
                                <option value=\"WorkingDays\">todos os dias úteis</option>
                                </select>
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Origem da linha do ônibus:
                            <br><input type=\"text\" id=\"origem\" name=\"origem\" placeholder=\"Informe a origem da linha do ônibus\">
                        </p>
                        <p class=\"title1 whiteTitle\">
                            Destino da linha do ônibus:
                            <br><input type=\"text\" id=\"destino\" name=\"destino\" placeholder=\"Informe o destino da linha do ônibus\">
                        </p>
                        <p>
                            <input type=\"button\" value=\"Cadastrar\" onclick=\"processLine('lineForm')\">
                        </p>
                        <input type=\"hidden\" id=\"operation\" name=\"operation\" value=\"save\">
                    </form>
                    ";
        
        // fixa o conteudo da grid
        $this->setGrid($model);
    }
}