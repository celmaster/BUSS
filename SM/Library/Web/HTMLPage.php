<?php

/* Classe criada para modelar paginas web com HTML
 *
 * Marcelo Barbosa
 * agosto, 2016.
 */

// declaracao do namespace
namespace SM\Library\Web;

// importacao de classes
use SM\Library\Interfaces\iHTMLPage;
use SM\Library\Collection\ArrayList;
use SM\Library\Web\Meta\KeyWord;
use SM\Library\Web\Meta\Author;
use SM\Library\Database\Context\Context;
use SM\Library\Database\Context\ContextElement;
use SM\Library\Interfaces\IContextObject;

// declaracao da classe abstratra
abstract class HTMLPage extends WebPage implements iHTMLPage, IContextObject
{
    // declaracao de atributos    
    private $cssScripts;            // lista de scripts css    
    private $jsScripts;             // lista de scripts js
    private $authors;               // lista de autores (*elemento de contexto)
    private $keywords;              // lista de palavras-chave (*elemento de contexto)
    private $description;           // descricao da pagina (*elemento de contexto)
    
    // declaracao de metodos
    public function __construct($title = "HTML document", $chaset = "utf-8", $lang = "pt-br", $description = "") 
    {
        // metodo construtor
        parent::__construct($title, $chaset, $lang);
        
        $this->setHead("<head>\n" 
                    . "<title>" . $this->getTitle() . "</title>\n"                
                    . "<!-- Charset -->\n"
                    . "<!-- Description -->\n"
                    . "<!-- KeyWords -->\n"
                    . "<!-- Authors -->\n"
                    . "<!-- Script CSS -->\n"
                    . "<!-- Script JS -->"
                    . "\n</head>\n");                
        
        $this->cssScripts = new ArrayList("Lista de scripts CSS");
        $this->jsScripts = new ArrayList("Lista de scripts Javascript");
        $this->keywords = new ArrayList("keywords");
        $this->authors = new ArrayList("authors");
        $this->description = $description;
    }
        
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    // metodos de transformacao de dados
    public function addCSSScript(CSSFileScript $css)
    {
        // adiciona um script css a lista de scripts do documento
        $this->cssScripts->add($css);
    }
    
    public function addJSScript(JSFileScript $js) 
    {
        // adiciona um script js a lista de scripts do documento
        $this->jsScripts->add($js);
    }
    
    public function cleanAuthors() 
    {
        // limpa todos os autores
        $this->authors->destroy();
    }
    
    public function cleanCSSScripts() 
    {
        // limpa todos os scripts css
        $this->cssScripts->destroy();
    }
    
    public function cleanJSScripts() 
    {
        // limpa todos os scripts js
        $this->jsScripts->destroy();
    }
    
    public function cleanKeyWords() 
    {
        // limpa todas palavras-chave
        $this->keywords->destroy();
    }
    
    public function cleanScripts() 
    {
        // limpa todos os scripts
        $this->cleanCSSScripts();
        $this->cleanJSScripts();
    }
    
    public function addKeyWord($keyword)
    {
        // adiciona um item a lista de palavras-chave
        $this->keywords->add(new KeyWord($keyword));
    }
    
    public function addKeyWords(array $array = null)
    {
        // adiciona palavras-chaves de um array a lista de termos
        // declaracao de variaveis
        $amount = count($array);
        
        if($amount > 0)
        {
            foreach ($array as $value) 
            {
                $this->keywords->add(new KeyWord($value));
            }
        }        
    }
    
    public function addAuthor($name)
    {
        // adiciona um autor a lista de autores
        $this->authors->add(new Author($name));
    }
    
    public function getDescriptionTag()
    {
        // obtem a tag de descricao do documento web se seu atributo tiver valor
        // declaracao de variaiveis
        $descriptionTag = "";
        
        if($this->getDescription() != "")
        {
            $descriptionTag = "<meta name=\"description\" content=\"".$this->getDescription()."\">\n";
        }
        
        // retorno de valor
        return $descriptionTag;
    }
    
    private function getAuthorTag($name)
    {
        // retorna uma meta tag com o nome do autor do documento web
        // declaracao de variaveis
        $authorTag = "<meta name=\"author\" content=\"".$name."\">\n";
        
        // retorno de valor
        return $authorTag;
    }
    
    public function getKeyWords()
    {
        // retorna a meta tag de palavras-chave
        // declaracao de variaveis
        $metatag = "";        
        $node = null;
        $keyword = null;
            
        // verifica se a lista de termos possui elementos
        if($this->keywords->getSize() > 0)
        {
            $metatag .= "<meta name=\"keywords\" content=\"";
            
            for($i = 0; $i < $this->keywords->getSize(); $i++)
            {
                $node = $this->keywords->get($i);
                $keyword = $node->getObject();
                
                if(($i + 1) < $this->keywords->getSize())
                {
                    $metatag .= $keyword->getValue() . ", ";
                }else
                    {
                        $metatag .= $keyword->getValue() . "";
                    }
            }
            
            $metatag .= "\">\n";
        }
        
        // retorno de valor
        return $metatag;
    }
    
    public function getAuthors()
    {
        // retorna o conjunto de meta tags dos autores do documento web
        // declaracao de variaveis
        $metatag = "";
        $node = null;
        $author = null;
        
        if($this->authors->getSize() > 0)
        {
            for($i = 0; $i < $this->authors->getSize(); $i++)
            {
                $node = $this->authors->get($i);
                $author = $node->getObject();
                $metatag .= $this->getAuthorTag($author->getName());
            }
        }
        
        //retorno de valor
        return $metatag;
    }
    
    private function getAllScripts(ArrayList $list)
    {
        $scripts = "";
        $node = null;
        $script = null;
        
        // pegando os scripts
        for($i = 0; $i < $list->getSize(); $i++)
        {
            $node = $list->get($i);
            
            $script = $node->getObject();
            $scripts .= $script->getTagScript();
        }
        
        // retorno de valor
        return $scripts;
    }
    
    public function getAllCSSScripts() 
    {
        // retorna todos os scripts css em uma string formatada
        
        // retorno de valor
        return $this->getAllScripts($this->cssScripts);
    }
    
    public function getAllJSScripts() 
    {
        // retorna todos os scripts js em uma string formatada
               
        // retorno de valor
        return $this->getAllScripts($this->jsScripts);
    }
    
    public function addContent($content) 
    {
        // adiciona conteudo ao corpo do documento
        // declaracao de variaveis
        $body = str_replace("<!-- @Content -->", "<!-- @Content -->\n" . $content, $this->getBody());        
        $this->setBody($body);        
    }
    
    public function addHeaderContent($headerContent) 
    {
        // adiciona ao cabecalho do corpo do documento
        // declaracao de variaveis
        $body = str_replace("<!-- @Header -->", "<!-- @Header -->\n" . $headerContent, $this->getBody());        
        $this->setBody($body);        
    }
    
    public function addFooterContent($footerContent) 
    {
        // adiciona conteudo ao rodape do documento
        // declaracao de variaveis
        $body = str_replace("<!-- @Footer -->", "<!-- @Footer -->\n" . $footerContent, $this->getBody());        
        $this->setBody($body);        
    }
    
    public function addContentByCommentTag($commentTag, $content)
    {
        // adiciona conteudo a alguma marcacao do documento
        // declaracao de variaveis
        if(strpos($commentTag, "<!--") !== false)
        {
            $body = str_replace($commentTag, $commentTag . "\n" . $content, $this->getBody());        
            $this->setBody($body);
        }
    }
    
    public function addHeadContent() 
    {
        // adiciona scripts e metatags ao cabecalho do  documento
        // declaracao de variaveis
        $headContent = $this->getHead();
        
        // organizacao do conteudo do cabecalho
        $headContent = str_replace("<!-- Script CSS -->", "<!-- Script CSS -->" . $this->getAllCSSScripts(), $headContent);
        $headContent = str_replace("<!-- Script JS -->", "<!-- Script JS -->" . $this->getAllJSScripts(), $headContent);
        $headContent = str_replace("<!-- Charset -->", "\n<!-- Charset -->\n" . "<meta charset=\"".$this->getCharset()."\">\n", $headContent);
        $headContent = str_replace("<!-- Description -->", "<!-- Description -->\n" . $this->getDescriptionTag(), $headContent);        
        $headContent = str_replace("<!-- KeyWords -->", "<!--KeyWords -->\n" . $this->getKeyWords(), $headContent);        
        $headContent = str_replace("<!-- Authors -->", "<!--Authors -->\n" . $this->getAuthors(), $headContent);        
        $this->setHead($headContent);
    }
       
    public function getContext() 
    {
        // retorna o contexto da classe
        $context = new Context();
        $context->add(new ContextElement("title", $this->getTitle()));
        $context->add(new ContextElement("charset", $this->getCharset()));
        $context->add(new ContextElement("lang", $this->getLang()));
        $context->add(new ContextElement("authors", $this->authors));        
        $context->add(new ContextElement("keywords", $this->keywords));
        $context->add(new ContextElement("description", $this->getDescription()));        
        
        // retorno de valor
        return $context;
    }
}