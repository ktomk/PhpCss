<?php
/**
 * PhpCss Demo: Scan a CSS Selector
 * 
 * This Demo loads a CSS Selector into the Scanner
 */

/* Setup Demo Environment */
require_once('inc/setup.php');

print("PhpCss Demo: Scan a simple CSS Selector\n\n");

$css = 'body#id .class';

printf("CSS Selector (%d): %s\n", strlen($css), $css);

$tokens = array();
$status = new PhpCssScannerStatusSelector();
$scanner = new PhpCssScanner($status);

$offset = $scanner->scan($tokens, $css);

printf("Tokens: %d; Offset: %d\n", count($tokens), $offset);

foreach($tokens as $token) {
	printf("Tokens: %s\n", $token);
}

