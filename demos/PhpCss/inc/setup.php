<?php
/**
 * PhpCss Demo: Setup Include
 */

/* Load PhpCss files */
$PhpCssPath = dirname(__FILE__).'/../../../src/PhpCss/';
require_once($PhpCssPath.'Loader.php');
PhpCssLoader::addAutoloadFile($PhpCssPath.'/Loader/Scanner.php');
spl_autoload_register('PhpCssLoader::autoload');