<?php

// importacao do autoload
require_once('SM/autoload.php');

// importacao de pacotes
use SM\Library\Web\Template\BUSSTemplate;
use SM\Library\Web\Template\DataGridModel\NewsTitle;
use SM\Library\Web\Template\DataGridModel\ScheduleTitle;
use SM\Library\Web\Template\DataGridModel\News;
use SM\Library\Web\Template\DataGridModel\Schedule;
use SM\Library\Web\Template\DataGridModel\BusSchedule;
use SM\Library\Web\Template\DataGridModel\BussNewsGrid;
use SM\Library\Web\Template\DataGridModel\BussUserForm;
use SM\Library\Database\NoticiaDAO;
use SM\Library\Database\LinhaDAO;
use SM\Library\Utils\TimeStamp;
use SM\Library\Utils\ProcessContext;
use SM\Library\Web\CSSFileScript;
use SM\Configuration\SystemConfiguration;
use SM\Configuration\DbConfiguration;
use SM\Library\Utils\BUSS\InterfaceAdapter;
use SM\Library\Model\UserProfile;
use SM\Library\Database\UserProfileDAO;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Utils\JSONManager;

// inicializa os bancos de dados caso nao existam
DbConfiguration::hasDataSystem();
DbConfiguration::hasBUSSDataSystem();

// instanciacao do aplicativo
$page = new BUSSTemplate("BUSS");

// obtem o perfil de usuario corrente e caso nao exista
$userProfileDAO = new UserProfileDAO();
$userProfile = new UserProfile();
$interestCondition = null;
$interestContext = null;

if($userProfileDAO->getQuantityOfRegisters() > 0)
{
    $userProfile = $userProfileDAO->getFirst();
}else
    {
        $userProfileDAO->insert($userProfile);
    }

// adaptacao da interface mediante o perfil do usuario
$cssScript = InterfaceAdapter::getStyleByUserProfile($userProfile);
$page->addCSSScript(new CSSFileScript(SystemConfiguration::getCSSDir(), $cssScript));

// instanciacao dos componentes da interface
$newsTitle = new NewsTitle("Notícias");
$scheduleTitle = new ScheduleTitle("Fique atento aos horários dos ônibus");
$news = new News();
$schedule = new Schedule();
$bussUserForm = new BussUserForm($userProfile->getTimeOfOccurrence());

// obtem a condicao de selecao de noticias via interesse
if($userProfile->getInterest() != "")
{
    $array = JSONManager::jsonToArray($userProfile->getInterest());
    $interestContext = new Context();
    $index = 1;

    foreach ($array->{"interest"} as $value) 
    {
        $interestContext->add(new ContextElement("interest".$index, $value));
        $index += 1;
    }

    $interestCondition = ProcessContext::getConditionByFieldDisjunction($interestContext, "categoria");
}

// carrega as noticias sobre a secao apropriada do aplicativo
$noticiaDao = new NoticiaDAO();
$bussNews = new BussNewsGrid($noticiaDao->getList($interestContext, $interestCondition, "dataDaPostagem, horaDaPostagem DESC", 0, 10));

// carrega os horarios das linhas de onibus no cronograma do aplicativo
$linhaDao = new LinhaDAO();
$timestamp = new TimeStamp();
$condition = "horarioIda > ".$timestamp->getStrTimeToSeconds($timestamp->getCurrentTime())." AND diaDaSemana = '" . 
             $timestamp->getWorkingWeekday()."'";
$busSchedule = new BusSchedule($linhaDao->getList(null, $condition, "horarioIda", 0, 4));

// agregacao de conteudo ao aplicativo
$page->addContent($newsTitle->getGrid() . 
                  $scheduleTitle->getGrid() .
                  $news->getGrid() .
                  $schedule->getGrid() . 
                  $bussUserForm->getGrid());
$page->addContentByCommentTag("<!-- @Schedule -->", $busSchedule->getGrid());
$page->addContentByCommentTag("<!-- @News -->", $bussNews->getGrid());

// adiciona metadados ao aplicativo
$page->addAuthor("Marcelo Barbosa");
$page->addKeyWords(array("IoT Bus Stop", "Accessibility"));

// imprime o conteudo do aplicativo
echo $page->toString();