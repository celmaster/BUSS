/* Biblioteca de funcoes javascript
 *
 * Marcelo Barbosa,
 * setembro, 2016.
 */


// variaveis globais 


// declaracao de funcoes
function exist(id)
{
    // verifica se um elemento existe
    // declaracao de variaveis
    var status = false;

    if (document.getElementById(id))
    {
        status = true;
    }

    // retorno de valor
    return status;
}

function sendForm(id)
{
    // envia um formulario
    if (exist(id))
    {
        document.getElementById(id).submit();
    }
}

function showNavbar(status)
{
    // exibe a navbar
    if (exist("navbar") && exist("darkbackground") && exist("navbutton") && exist("scenary"))
    {
        // declaracao de variaveis
        var navbar = document.getElementById("navbar");
        var background = document.getElementById("darkbackground");
        var navbutton = document.getElementById("navbutton");
        var scenary = document.getElementById("scenary");

        // altera as classes
        if (status)
        {
            navbutton.className = "nonDisplay";
            navbar.className = "navbar";
            background.className = "darkbackground";
            scenary.className = "nonDisplay";
        }else
            {
                navbar.className = "nonDisplay";
                background.className = "nonDisplay";
                navbutton.className = "navbutton";
                scenary.className = "scenary";
            }
    }
}

function navLink(id)
{
    // faz navegacao de conteudo por id
    // oculta a navbar
    showNavbar(false);

    // realiza a navegacao
    window.location.href = "#" + id;
}

function navPage(page)
{
    // faz navegacao de conteudo por pagina
    // oculta a navbar
    showNavbar(false);

    // realiza a navegacao
    window.location.href = page;
}

function getTimeSeconds(h, m, s)
{
    // retorna um horario em segundos
    var seconds = ((h * 3600) + (m * 60) + s);

    // retorno de valor
    return seconds;
}

function normalize(value)
{
    // normaliza um valor com zero a esquerda
    // declaracao de variaveis
    var str = "" + value;

    if (value < 10)
    {
        str = "0" + str;
    }

    // retorno de valor
    return str;
}

function makeLogin(formId)
{
    // valida os dados de um usuario para login no sistema
    if (exist(formId))
    {
        if (exist("email") && exist("senha"))
        {
            var email = document.getElementById("email").value;
            var senha = document.getElementById("senha").value;

            // premissas
            var statement = (email != "") && (senha != "");

            if (statement)
            {
                sendForm(formId);
            }else
                {
                    alert("Os campos estão vazios!");
                }
        }
    }
}

function letsgo(page)
{
    // navega por uma pagina
    window.location.href = page;
}

function recordCategory(formId)
{
    // valida os dados de uma categoria para cadastro
    if (exist(formId))
    {
        if (exist("categoria"))
        {
            var categoria = document.getElementById("categoria").value;

            // premissas
            var statement = (categoria != "");

            if (statement)
            {
                sendForm(formId);
            }else
                {
                    alert("O campo está vazio!");
                }
        }
    }
}

function updateCategory(formId)
{
    // valida os dados de uma categoria para cadastro
    if (exist(formId))
    {
        if (exist("categoria") && exist("nomeAntigoDaCategoria"))
        {
            var categoria = document.getElementById("categoria").value;
            var categoriaAntiga = document.getElementById("nomeAntigoDaCategoria").value;

            // premissas
            var statement1 = (categoria != "");
            var statement2 = categoria != categoriaAntiga;

            if (statement1 && statement2)
            {
                sendForm(formId);
            }else
                {
                    var message = "";
                    
                    if(!statement1)
                    {
                        message = "O campo está vazio!";
                    }
                    
                    if(!statement2)
                    {
                        message = "Os dados nao foram modificados e nao ha necessidade de atualiza-los";
                    }
                    
                    alert(message);
                }
        }
    }
}

function recordNews(formId)
{
    // valida os dados de uma noticia para cadastro
    if (exist(formId))
    {
        if (exist("titulo") && exist("categoria") && exist("ilustracao") && exist("texto"))
        {
            var titulo = document.getElementById("titulo").value;
            var categoria = document.getElementById("categoria").value;
            var ilustracao = document.getElementById("ilustracao").value;
            var texto = document.getElementById("texto").value;

            // premissas
            var statement = (titulo != "") && (categoria != "#") && (texto != "") && (ilustracao != "");

            if (statement)
            {
                sendForm(formId);
            }else
                {
                    alert("Por favor, preencha todos os campos do formulario corretamente!");
                }
        }
    }
}

function updateNews(formId)
{
    // valida os dados de uma noticia para atualizacao
    if (exist(formId))
    {
        if (exist("titulo") && exist("categoria") && exist("texto"))
        {
            var titulo = document.getElementById("titulo").value;
            var categoria = document.getElementById("categoria").value;            
            var texto = document.getElementById("texto").value;

            // premissas
            var statement = (titulo != "") && (categoria != "#") && (texto != "");

            if (statement)
            {
                sendForm(formId);
            }else
                {
                    alert("Por favor, preencha todos os campos do formulario corretamente!");
                }
        }
    }
}

function processLine(formId)
{
    // valida os dados de uma linha de onibus e submete o formulario
    if (exist(formId))
    {
        if (exist("id") && exist("horarioDeIda") && exist("horarioDeVolta") && exist("origem") && exist("destino") && exist("diaDaSemana"))
        {
            var id = document.getElementById("id").value;
            var horarioDeIda = document.getElementById("horarioDeIda").value;
            var horarioDeVolta = document.getElementById("horarioDeVolta").value;
            var origem = document.getElementById("origem").value;
            var destino = document.getElementById("destino").value;
            var diaDaSemana = document.getElementById("diaDaSemana").value;
            var message = "";

            // premissas
            var statement1 = (id != "") && (horarioDeIda != "#") && (horarioDeVolta != "#") && (origem != "") && (destino != "") && (diaDaSemana != "#");
            var statement2 = isTime(horarioDeIda) && isTime(horarioDeVolta) && evaluateLength("horarioDeIda", 8) && evaluateLength("horarioDeVolta", 8);
            
            if(!statement2)
            {
                message += "Horario invalido! Favor corrigir.";
            }

            if (statement1 && statement2)
            {
                sendForm(formId);
            }else
                {
                    alert("Por favor, preencha todos os campos do formulario corretamente!\n"+message);
                }
        }
    }
}

function cleanForm(idForm)
{
    // limpa os dados de campos/areas de texto e passwords de um formulario
    // declaracao de variaveis
    var inputTexts;
    var textArea;

    if (document.getElementById(idForm))
    {

        inputTexts = document.getElementsByTagName("INPUT");
        textArea = document.getElementsByTagName("TEXTAREA");

        for (var i = 0; i < inputTexts.length; i++)
        {

            if ((inputTexts[i].getAttribute("type") == "text") ||
                (inputTexts[i].getAttribute("type") == "password"))
            {
                document.getElementById(inputTexts[i].getAttribute("id")).value = "";
            }
        }

        for (var i = 0; i < textArea.length; i++)
        {
            document.getElementById(textArea[i].getAttribute("id")).value = "";
        }
    }

}

function equalsIgnoreCase(str1, str2)
{
    // retorna verdadeiro se duas strings sao iguais de modo case insensitive
    // declaracao de variaveis
    var firstString = "";
    var secondString = "";
    var valor = -1;

    if ((str1 != null) && (str2 != null))
    {
        firstString = new String(str1).toLowerCase();
        secondString = new String(str2).toLowerCase();
    }

    // compara as strings
    valor = firstString.localeCompare(secondString);

    // retorno de valor
    return valor;
}

function equals(str1, str2)
{
    // retorna verdadeiro se duas strings sao iguais
    // declaracao de variaveis    
    var firstString = "";
    var secondString = "";
    var valor = -1;

    if ((str1 != null) && (str2 != null))
    {
        firstString = new String(str1);
        secondString = new String(str2);
    }

    // compara as strings
    valor = firstString.localeCompare(secondString);

    // retorno de valor
    return valor;
}

function evaluateLength(idObject, length)
{
    // verifica se um campo contem uma dada quantidade de caracteres.

    if (document.getElementById(idObject))
    {
        var field = new String(document.getElementById(idObject).value);

        // faz a comparacao de quantidade de caracteres
        if (field.length == length)
        {
            return true;

        }else
            {
                return false;
            }
    }
}

function evaluateLengthLimit(idObject, length)
{
    // verifica se um campo nao ultrapassou a quantidade de caracteres disponivel

    if (document.getElementById(idObject))
    {
        var field = new String(document.getElementById(idObject).value);

        // faz a comparacao de quantidade de caracteres
        if (field.length <= length)
        {
            return true;

        }else
            {
                return false;
            }
    }
}

function createMask(id, mask)
{
    // cria uma mascara para um dado campo
    if (document.getElementById(id))
    {
        var maskText = new String(mask);
        var text = new String(document.getElementById(id).value);
        var newText = new String("");
        var position = text.length - 1;

        // pega o texto corrente
        newText = new String(text.substring(0, position));

        // concatena o valor com a mascara
        if (maskText.charAt(position) == "x")
        {
            newText = new String(newText.concat(text.charAt(position)));

        }else
            {
                newText = new String(newText.concat(maskText.charAt(position)));
                newText = new String(newText.concat(text.charAt(position)));
            }


        // colocando o valor obtido no campo referenciado
        document.getElementById(id).value = newText;
    }

}

function isEmail(address)
{
    // verifica se um endereco e um email valido

    var content = new String(address);

    if ((content.search(' ') == -1) && (content.search('@') > 0) &&
        ((content.search('.com') > content.search('@')) && (content.search('.com') - content.search('@') > 1)) ||
        ((content.search('.gov') > content.search('@')) && (content.search('.gov') - content.search('@') > 1)) ||
        ((content.search('.org') > content.search('@')) && (content.search('.org') - content.search('@') > 1)) ||
        ((content.search('.net') > content.search('@')) && (content.search('.net') - content.search('@') > 1)))
    {
        return true;

    }else
        {
            return false;
        }
}


function isNumber(value)
{
    // verifica se um campo e composto de numeros

    var content = new String(value);

    // formatando o valor recebido
    content = content.replace("(", "");
    content = content.replace(")", "");
    content = content.replace(".", "");
    content = content.replace("-", "");
    content = content.replace("_", "");
    content = content.replace("/", "");
    content = content.replace("/", "");
    content = content.replace(":", "");
    content = content.replace(":", "");
    content = content.replace(" ", "");

    if (isNaN(content.trim()))
    {
        return true;

    }else
        {
            return false;
        }

}

function validateLimit(begin, end, value)
{
    // avalia se um valor esta dentro de um limite 
    if((value >= begin) && (value <= end))
    {
        return true;
    }else
        {
            return false;
        }
}

function isPositive(value)
{
    // verifica se um numero e positivo
    if(value >= 0)
    {    
        return true;

    }else
        {
            return false;
        }
	
}

function isDate(value)
{
	// verifica se um valor e uma data valida
	var text = new String(value); 
	var day = parseInt(text.substring(0, 2));
	var month = parseInt(text.substring(3, 5));
	var year = parseInt(text.substring(6, 10));

	// montando proposicoes
	var isMonth28Days = ((day >= 1) && (day <= 28)) && (month == 2) && (year % 4 != 0);

	var isMonth29Days = ((day >= 1) && (day <= 29)) && (month == 2) && (year % 4 == 0);
	
	var isMonth30Days = ((month == 4) || (month == 6) || (month == 9) || 
			     (month == 11)) && ((day >= 1) && (day <= 30));

	var isMonth31Days = ((month == 1) || (month == 3) || (month == 5) || 
			     (month == 7) || (month == 8) || (month == 10) || 
			     (month == 12)) && ((day >= 1) && (day <= 31));
	

	// criando uma avaliacao das proposicoes
	var evaluate = (isMonth28Days || isMonth29Days || isMonth30Days || isMonth31Days);

	// retorno de valor
	return evaluate;
	
}

function isTime(value)
{
    // verifica se um valor e um horario valido
    var text = new String(value); 
    var hour = parseInt(text.substring(0, 2));
    var minute = parseInt(text.substring(3, 5));
    var second = parseInt(text.substring(6, 8));

    // montando proposicoes
    var isHour = ((hour >= 0) && (hour <= 23));        
    var isMinute = ((minute >= 0) && (minute <= 59));    
    var isSecond = ((second >= 0) && (second <= 59));

    // criando uma avaliacao das proposicoes
    var evaluate = (isHour && isMinute && isSecond);

    // retorno de valor
    return evaluate;
	
}

function copyValue(id1, id2)
{
    // copia o valor do objeto de id1 para o objeto de id2
    document.getElementById(id1).value = document.getElementById(id2).value;
}

function addValue(id, value)
{
    // adiciona o valor ao objeto pelo seu id
    document.getElementById(id).value = value;
}

function sendFormForManagement(formId, inputId, operation)
{
    // envia um formulario para gerenciamento de dados
    if(exist(formId) && exist(inputId))
    {
        
        if(operation == "update")
        {
            if(exist("updateAddress"))
            {
                document.getElementById(formId).action = document.getElementById("updateAddress").value;
            }
        }
        
        // altera o valor do campo de operacao
        document.getElementById(inputId).value = operation;
        
        // envia o formulario
        sendForm(formId);
    }
}

function updateUser(formId)
{
    // valida os dados de usuario para submeter o formulario de atualizacao de dados    
    if(exist(formId))
    {
        if(exist("nome") && exist("sobrenome") && exist("email") && exist("senha"))
        {
            // obtem os valores para validacao
            var nome = document.getElementById("nome").value;
            var sobrenome = document.getElementById("sobrenome").value;
            var email = document.getElementById("email").value;
            var senha = document.getElementById("senha").value;
            
            var statement = (nome != "") && (sobrenome != "") && (email != "") && (senha != "");
            
            if(statement)
            {
                // envia o formulario
                sendForm(formId);
            }else
                {
                    alert("Preencha todos os campos corretamente!");
                }
            
        }        
       
    }
}