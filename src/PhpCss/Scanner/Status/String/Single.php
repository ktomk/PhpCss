<?php
/**
* PhpCssScannerStatusStringSingle
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
* PhpCssScannerStatusStringSingle checks for tokens in a single quoted string.
*
* @package PhpCss
* @subpackage Scanner
*/
class PhpCssScannerStatusStringSingle extends PhpCssScannerStatusStringAbstract {
  public function __construct() {
    $this->quoteChar = "'";
    $this->tokenTypeEnd = PhpCssScannerToken::SINGLEQUOTE_STRING_END;
  }
}