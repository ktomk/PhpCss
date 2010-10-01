<?php
/**
* PhpCssScannerStatusStringDouble
* 
* Copyright (c) 2010 Bastian Feder, Thomas Weinert
*
* Licensed under the MIT License, see license.txt
*
* @version $Id: Single.php 429 2010-03-29 08:05:32Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2010 Bastian Feder, Thomas Weinert
*
* @package PhpCss
* @subpackage Scanner
*/

/**
* PhpCssScannerStatusStringDouble checks for tokens in a double quoted string.
*
* @package PhpCss
* @subpackage Scanner
*/
class PhpCssScannerStatusStringDouble extends PhpCssScannerStatusStringAbstract {
  public function __construct() {
    $this->quoteChar = '"';
    $this->tokenTypeEnd = PhpCssScannerToken::DOUBLEQUOTE_STRING_END;
  }
}
