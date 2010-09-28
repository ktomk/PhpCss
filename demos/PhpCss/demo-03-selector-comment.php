<?php
/**
 * PhpCss Demo: Scan CSS Selector with comments
 * 
 * This Demo loads a CSS Selector with comments into the Scanner
 * 
 */

/* Setup Demo Environment */
require_once('inc/setup.php');

print("PhpCss Demo: CSS Selector with Comments\n\n");

$css = 'bo/**/dy .cl/**/ass';

printf("CSS Selector '%s' (%d)\n", $css, strlen($css));

$tokens = array();
$status = new PhpCssScannerStatusComment();
$scanner = new PhpCssScanner($status);

$offset = $scanner->scan($tokens, $css);

printf("Tokens: %d; Offset: %d\n", count($tokens), $offset);

$i=0;
foreach($tokens as $token) {
	printf(" #%d: %s\n", ++$i, $token);
}

