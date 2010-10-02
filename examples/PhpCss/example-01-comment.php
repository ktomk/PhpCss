<?php
/**
 * PhpCss Demo: Scan a simple CSS with Comments
 * 
 * This Demo loads a CSS Fragment into the Scanner and
 * scans for Comments.
 */

/* Setup Demo Environment */
require_once('inc/setup.php');

print("PhpCss Demo: Scan a simple CSS with Comments\n\n");

$css = 'style /* comment */ style /* comment /******/ st/***inline***/yle';

printf("CSS Commented Styles (%d): %s\n", strlen($css), $css);

$tokens = array();
$status = new PhpCssScannerStatusComment();
$scanner = new PhpCssScanner($status);

$offset = $scanner->scan($tokens, $css);

printf("Tokens: %d; Offset: %d\n", count($tokens), $offset);

$i=0;
foreach($tokens as $token) {
	printf(" #%d: %s\n", ++$i, $token);
}

