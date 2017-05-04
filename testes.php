<?php

/* Script de testes
 * 
 * Marcelo Barbosa,
 * outubro, 2016.
 */

// inclusao do autoload
require_once('SM/autoload.php');

// inclusao das classes
use SM\Library\Database\UsuarioDAO;
use SM\Library\Model\Usuario;
use SM\Library\Database\NoticiaDAO;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Model\Noticia;
use SM\Library\Utils\TimeStamp;
use SM\Library\Utils\StringManager;
use SM\Library\Utils\BUSS\InterfaceAdapter;
use SM\Library\Model\UserProfile;
use SM\Library\IO\Session;
use SM\Library\Utils\Tools\FileTool;
use SM\Library\Utils\JSONManager;
use SM\Library\Utils\ProcessContext;
use SM\Library\Collection\ArrayList;

$profile = "{
    \"abilities\": [{
            \"predicate\": \"AbilityToSee\",
            \"subgroup\": \"Capabilities\",
            \"auxiliary\": \"has\",
            \"range\": \"low-medium-high\",
            \"object\": \"low\"
        }],
    \"interest\": [],
    \"interface_preferences\": [{
            \"predicate\": \"FontSize\",
            \"subgroup\": \"Layout\",
            \"auxiliary\": \"hasPreference\",
            \"range\": \"uninformed-small-medium-large\",
            \"object\": \"medium\"
        }, {
            \"predicate\": \"GraphicalElementSize\",
            \"subgroup\": \"Layout\",
            \"auxiliary\": \"hasPreference\",
            \"range\": \"uninformed-small-medium-large\",
            \"object\": \"medium\"
        }]
}";

$abilityToSee = "";
$fontSize = "";
$graphicalElementSize = "";
$interestList = new ArrayList("interest");

$json = JSONManager::jsonToArray($profile);

foreach ($json->{"abilities"} as $value) 
{
   if(StringManager::equalsIgnoreCase($value->{"predicate"}, "AbilityToSee"))
   {
       $abilityToSee = $value->{"object"};
   }
}

foreach ($json->{"interface_preferences"} as $value) 
{
   if(StringManager::equalsIgnoreCase($value->{"predicate"}, "FontSize"))
   {
       $fontSize = $value->{"object"};
   }else if(StringManager::equalsIgnoreCase($value->{"predicate"}, "GraphicalElementSize"))
       {
            $graphicalElementSize = $value->{"object"};
       }   
}


foreach ($json->{"interest"} as $value) 
{
   $subgroup = $value->{"subgroup"};
   if($interestList->getKeyOf($subgroup) === null)
   {
       $interestList->add($subgroup);
   }
}


echo $abilityToSee  . "<br>";
echo $fontSize  . "<br>";
echo $graphicalElementSize  . "<br>";
echo "<br>";
echo ProcessContext::getListToJSON($interestList);











