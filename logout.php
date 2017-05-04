<?php

/* Realiza o logout do usuario encerrando sua sessao
 * 
 * Marcelo Barbosa,
 * setembro, 2016.
 */

// importacao do autoload
require_once("SM/autoload.php");

// importacao de classes
use SM\Configuration\SystemConfiguration;
use SM\Library\IO\Session;

// fecha a sessao do usuario
Session::delete("email");
Session::delete("senha");
Session::delete("message");
Session::delete("type");
Session::delete("redirect");

// redireciona para o sistema tratar da validacao de usuarios
SystemConfiguration::letsgoByRoot("mainSystem.php");
