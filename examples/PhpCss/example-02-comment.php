<?php
/**
 * PhpCss Demo: Scan CSS File with Comments
 * 
 * This Demo loads CSS File into the Scanner and
 * scans it's comments.
 */

/* Setup Demo Environment */
require_once('inc/setup.php');

print("PhpCss Demo: Scan CSS File with Comments\n\n");

$css = file_get_contents(dirname(__FILE__).'/css/simple.css');

printf("CSS File. Length: %d\n", strlen($css));

$tokens = array();
$status = new PhpCssScannerStatusComment();
$scanner = new PhpCssScanner($status);

$offset = $scanner->scan($tokens, $css);

printf("Tokens: %d; Offset: %d\n", count($tokens), $offset);

$i=0;
foreach($tokens as $token) {
	printf(" #%d: %s\n", ++$i, $token);
}

