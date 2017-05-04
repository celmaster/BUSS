/* Biblioteca de funcoes javascript
 *
 * Marcelo Barbosa,
 * agosto, 2016.
 */


// variaveis globais 
var newsEventHandlerAjax = null;
var profileEventHandlerAjax = null;

// declaracao de funcoes
function getHandlerAjax()
{
    // retorna um objeto Ajax
    // declaracao de variaveis
    var handler = null;
    
    if(window.XMLHttpRequest)
    {
        try
        {
            handler = new XMLHttpRequest();
        }catch(e)
              {
                  handler = false;
              }
    }else if(window.ActiveXObject)
          {
              try
              {
                  handler = new ActiveXObject("Msxml2.XMLHTTP");
              }catch(e)
                    {
                        try
                        {
                            handler = new ActiveXObject("Microsoft.XMLHTTP");
                        }catch(e)
                              {
                                  handler = false;
                              }
                    }
          }
    
    // retorno de valor
    return handler;
}

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

function getTime(target)
{
    // obtem o horario corrente
    if (exist(target))
    {
        // declaracao de variaveis
        var d = new Date();
        var sec = d.getSeconds();
        var min = d.getMinutes();
        var hrs = d.getHours();
        var time = "";

        // formaliza o tempo
        time += normalize(hrs) + ":" + normalize(min) + ":" + normalize(sec);
        document.getElementById(target).innerText = time;
    }
}

function getTimeBus(id, idInputSeconds)
{
    // obtem o tempo restante para que o onibus passe
    
    if (exist(id))
    {
        // declaracao de variaveis
        var d = new Date();
        var sec = d.getSeconds();
        var min = d.getMinutes();
        var hrs = d.getHours();
        var now = getTimeSeconds(hrs, min, sec);

        var busTime = 0;

        if(exist(idInputSeconds))
        {
            busTime = document.getElementById(idInputSeconds).value;
        }

        var time = busTime - now;
        if (time < 0)
        {
            time = 0;
        }

        var hora = time / 3600;
        var minuto = (hora - parseInt(hora)) * 60;
        var segundos = (minuto - parseInt(minuto)) * 60;

        var mensagem = "-";

        if (hora > 1)
        {
            mensagem = "" + parseInt(hora) + "h";

            if (minuto > 1)
            {
                mensagem = "" + parseInt(hora) + "h " + parseInt(minuto) + "min";
            }

        }else if (hora == 1)
              {
                  mensagem = "1h";

                  if (minuto >= 59)
                  {
                      mensagem = "+1h";
                  }

              }else
                  {
                      if (minuto > 1)
                      {
                          mensagem = "" + parseInt(minuto) + "min";
                          
                          if (segundos > 1)
                          {
                              mensagem = "" + parseInt(minuto) + "min " + parseInt(segundos) + "s";
                          }

                      }else if (minuto == 1)
                            {
                                mensagem = "1min";

                                if (segundos >= 59)
                                {
                                    mensagem = "+1min";
                                }

                            }else
                                {
                                    if (segundos > 1)
                                    {
                                        mensagem = "" + parseInt(segundos) + "s";
                                    }else if (segundos == 1)
                                          {
                                              mensagem = "1s";
                                          }else
                                            {
                                                window.location.reload();
                                            }
                                }

                    }
        
        document.getElementById(id).innerHTML = mensagem;
    }

}

function refreshBySchedule(hours, minutes, seconds)
{
    // atualiza a pagina caso o horario atual seja igual ao especificado
    // declaracao de variaveis
    var d = new Date();
    var sec = d.getSeconds();
    var min = d.getMinutes();
    var hrs = d.getHours();
    
    var statement = (hours == hrs) && (minutes == min) && (seconds == sec);
    
    if(statement)
    {
        window.location.reload();
    }
}

function newsEventMonitor()
{
    // aceita um evento de obtencao de dados de um dispositivo e atualiza a pagina
    // verifica se houve exito em carregar os dados no arquivo php
    try
    {
        if(newsEventHandlerAjax.readyState == 4)
        {
            // verifica se ha dados retornados
            if(newsEventHandlerAjax.status == 200)        
            {
                console.log(newsEventHandlerAjax.responseText);
                if(newsEventHandlerAjax.responseText.indexOf("1") > -1)
                {
                    // atualiza a pagina
                    window.location.reload();
                }    
            }   
        }    
    }catch(e)
        {
            // retorna nulo
            return null;
        }
}

function profileEventMonitor()
{
    // aceita um evento de obtencao de dados de um dispositivo e atualiza a pagina
    // verifica se houve exito em carregar os dados no arquivo php
    try
    {
        if(profileEventHandlerAjax.readyState == 4)
        {
            // verifica se ha dados retornados
            if(profileEventHandlerAjax.status == 200)        
            {
                console.log(profileEventHandlerAjax.responseText);
                if(profileEventHandlerAjax.responseText.indexOf("1") > -1)
                {
                   // atualiza a pagina
                   window.location.reload();
                }    
            }   
        }    
    }catch(e)
        {
            // retorna nulo
            return null;
        }
}

function newsMonitorByAjax()
{
    // verifica a existencia de noticias mais recentes
    try
    {
        newsEventHandlerAjax = getHandlerAjax();
        var url = null;
        var newsDate = null;
        var newsTime = null;
        var serviceOperation = null;

        if(exist("bussNewsForm"))
        {
           
            if(exist("newsDate") && exist("newsTime") && exist("serviceOperation"))
            {                
                url = document.getElementById("bussNewsForm").action;
                newsDate =  document.getElementById("newsDate").value;
                newsTime =  document.getElementById("newsTime").value;
                serviceOperation =  document.getElementById("serviceOperation").value;
                
                newsEventHandlerAjax.open("POST", url, true);
                newsEventHandlerAjax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                newsEventHandlerAjax.send("newsDate="+newsDate+
                                          "&newsTime="+newsTime+
                                          "&serviceOperation="+serviceOperation);
                newsEventHandlerAjax.onreadystatechange = newsEventMonitor;
            }
        }
    }catch(e)
        {
            // retorna nulo
            return null;
        }
    
}

function profileMonitorByAjax()
{
    // verifica a necessidade de adaptar a interface do aplicativo
    try
    {
        profileEventHandlerAjax = getHandlerAjax();
        var url = null;
        var userTimestamp;
        var appName;
        var serviceOperation = null;

        if(exist("bussUserForm"))
        {           
            if(exist("userFormTimestamp") && exist("appNameFormTimestamp") && exist("userFormServiceOperation"))
            {   
                url = document.getElementById("bussUserForm").action;
                userTimestamp = document.getElementById("userFormTimestamp").value;  
                appName = document.getElementById("appNameFormTimestamp").value;  
                serviceOperation = document.getElementById("userFormServiceOperation").value;                

                profileEventHandlerAjax.open("POST", url, true);
                profileEventHandlerAjax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                profileEventHandlerAjax.send("userTimestamp="+userTimestamp+
                                          "&appName="+appName+
                                          "&serviceOperation="+serviceOperation);
                profileEventHandlerAjax.onreadystatechange = profileEventMonitor;
            }
        }
    }catch(e)
        {
            // retorna nulo
            return null;
        }
    
}

// declaracao de threads
window.setInterval(function ()
{
    newsMonitorByAjax();
}, 3000);

window.setInterval(function ()
{
    profileMonitorByAjax();
}, 1500);

window.setInterval(function ()
{
    getTime('clockBlock');
}, 1000);

window.setInterval(function ()
{
    getTimeBus('timer0', 'timestamp0');
}, 700);

window.setInterval(function () 
{
    getTimeBus('timer1', 'timestamp1')
}, 700);

window.setInterval(function ()
{
    getTimeBus('timer2', 'timestamp2')
}, 700);

window.setInterval(function () 
{
    getTimeBus('timer3', 'timestamp3')
}, 700);

// atualiza o sistema durante as 4 hrs
window.setInterval(function () 
{
    refreshBySchedule(4, 0, 0);
}, 1000);

