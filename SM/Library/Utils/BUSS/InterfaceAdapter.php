<?php

/* Classe estatica criada para adaptar a interface do aplicativo BUSS
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// declaracao do namespace
namespace SM\Library\Utils\BUSS;

// importacao de classes
use SM\Library\Model\UserProfile;
use SM\Library\Utils\StringManager;

// declaracao da classe
class InterfaceAdapter
{
    // declaracao de metodos
    public static function getStyleByUserProfile(UserProfile $userProfile)
    {
        // declaracao de variaveis
        $AbilityToSee = $userProfile->getAbilityToSee();
        $FontSize = $userProfile->getFontSize();
        $GraphicalElementSize = $userProfile->getGraphicalElementSize();
        
        // premissas
        $AbilityToSeeIsUninformed = StringManager::equalsIgnoreCase($AbilityToSee, "uninformed") 
                                    || StringManager::equalsIgnoreCase($AbilityToSee, "");
        $FontSizeIsUninformed = StringManager::equalsIgnoreCase($FontSize, "uninformed") 
                                || StringManager::equalsIgnoreCase($FontSize, "");
        $GraphicalElementSizeIsUninformed = StringManager::equalsIgnoreCase($GraphicalElementSize, "uninformed") 
                                            || StringManager::equalsIgnoreCase($GraphicalElementSize, "");

        // normaliza o atributo de habilidade de visao
        if($AbilityToSeeIsUninformed)
        {
            $AbilityToSee = "high";
        }
        
         // normaliza o atributo de preferencia pelo tamanho de fonte e, caso necessario, o de habilidade de visao
        if(!$FontSizeIsUninformed)
        {
            $AbilityToSee = InterfaceAdapter::normalizeAbilityToSeeByFontSize($FontSize);
        }else
            {
                $FontSize = InterfaceAdapter::normalizeFontSizeByAbilityToSee($AbilityToSee);                
            }

        // normaliza o atributo de preferencia pelo tamanho de elementos graficos
        if($GraphicalElementSizeIsUninformed)
        {
            $GraphicalElementSize = InterfaceAdapter::normalizeGraphicalElementSizeByAbilityToSee($AbilityToSee);
        }    

        // retorno de valor
        return InterfaceAdapter::getCSSScript($AbilityToSee, $FontSize, $GraphicalElementSize);        
    }
    
    private static function getCSSScript($AbilityToSee, $FontSize, $GraphicalElementSize)
    {
        // obtem um script css atraves de inferencia logica
        // declaracao de variaveis
        $CSSFile = "defaultStyle.css";
        
        // premissas
        $highAbStyle1 = ((strcmp($AbilityToSee, "high") == 0)) && (strcmp($FontSize, "small") == 0) && (strcmp($GraphicalElementSize, "medium") == 0);
        $highAbStyle2 = ((strcmp($AbilityToSee, "high") == 0)) && (strcmp($FontSize, "small") == 0) && (strcmp($GraphicalElementSize, "large") == 0);

        $mediumAbStyle1 = ((strcmp($AbilityToSee, "medium") == 0)) && (strcmp($FontSize, "medium") == 0) && (strcmp($GraphicalElementSize, "small") == 0);
        $mediumAbStyle2 = ((strcmp($AbilityToSee, "medium") == 0)) && (strcmp($FontSize, "medium") == 0) && (strcmp($GraphicalElementSize, "medium") == 0);
        $mediumAbStyle3 = ((strcmp($AbilityToSee, "medium") == 0)) && (strcmp($FontSize, "medium") == 0) && (strcmp($GraphicalElementSize, "large") == 0);

        $lowAbStyle1 = ((strcmp($AbilityToSee, "low") == 0)) && (strcmp($FontSize, "large") == 0) && (strcmp($GraphicalElementSize, "small") == 0);
        $lowAbStyle2 = ((strcmp($AbilityToSee, "low") == 0)) && (strcmp($FontSize, "large") == 0) && (strcmp($GraphicalElementSize, "medium") == 0);
        $lowAbStyle3 = ((strcmp($AbilityToSee, "low") == 0)) && (strcmp($FontSize, "large") == 0) && (strcmp($GraphicalElementSize, "large") == 0); 
        
        // processamento logico de premissas
        if($highAbStyle1)
        { 
            $CSSFile = "highAbStyle1.css";

        }else if($highAbStyle2)
              {
                    $CSSFile = "highAbStyle2.css";

              }else if($mediumAbStyle1)
                    {
                          $CSSFile = "mediumAbStyle1.css";

                    }else if($mediumAbStyle2)
                          {
                              $CSSFile = "mediumAbStyle2.css";

                          }else if($mediumAbStyle3)
                                {
                                      $CSSFile = "mediumAbStyle3.css";
                                }else if($lowAbStyle1)
                                      {
                                            $CSSFile = "lowAbStyle1.css";

                                      }else if($lowAbStyle2)
                                            {
                                                  $CSSFile = "lowAbStyle2.css";

                                            }else if($lowAbStyle3)
                                                  {
                                                       $CSSFile = "lowAbStyle3.css";                                                               
                                                  }
        // retorno de valor
        return $CSSFile;     
    }
    
    private static function normalizeAbilityToSeeByFontSize($FontSize)
    {
        // normaliza o atributo de habilidade para ver atraves do tamanho da fonte
        // declaracao de variaveis
        $AbilityToSee = "";
        
        switch ($FontSize)
        {
            case "small":
                $AbilityToSee = "high";   
            break;    

            case "medium":
                $AbilityToSee = "medium";   
            break;

            case "large":
                $AbilityToSee = "low";   
            break;    

            default:
                 $AbilityToSee = "high";   
            break;    
        }        
        
        // retorno de valor
        return $AbilityToSee;
    }
    
    private static function normalizeFontSizeByAbilityToSee($AbilityToSee)
    {
        // normaliza o atributo de tamanho de fonte pela habilidade de visao
        // declaracao de variaveis
        $FontSize = "";
        
        switch ($AbilityToSee)
        {
            case "high":
                $FontSize = "small";                
            break; 

            case "medium":
                $FontSize = "medium";                
            break;

            case "low":
                $FontSize = "large";                
            break;

            default:
                $FontSize = "small";                
            break;
        }
        
        // retorno de valor
        return $FontSize;
    }
    
    private static function normalizeGraphicalElementSizeByAbilityToSee($AbilityToSee)
    {
        // normaliza o atributo de tamanho de elementos graficos pela habilidade de visao
        // declaracao de variaveis
        $GraphicalElementSize = "";
        
        switch ($AbilityToSee)
        {
            case "high":                
                $GraphicalElementSize = "small";
            break; 

            case "medium":                
                $GraphicalElementSize = "medium";
            break;

            case "low":                
                $GraphicalElementSize = "large";
            break;

            default:                
                $GraphicalElementSize = "small";
            break;
        }
        
        // retorno de valor
        return $GraphicalElementSize;
    }
    

}

