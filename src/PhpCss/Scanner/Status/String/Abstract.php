<?php
/**
* PhpCssScannerStatusStringAbstract 
* 
* Copyright (c) 2010 Bastian Feder, Thomas Weinert, Tom Klingenberg
* 
* Licensed under the MIT License, see license.txt
* 
* @version $Id: $
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
abstract class PhpCssScannerStatusStringAbstract extends PhpCssScannerStatus {
  
  protected $quoteChar;
  protected $tokenTypeEnd;

  /**
  * Try to get token in buffer at offset position.
  *
  * @param string $buffer
  * @param integer $offset
  * @return PhpCssScannerToken
  */
  public function getToken($buffer, $offset) {
    $quoteChar = $this->quoteChar;
    $tokenTypeEnd = $this->tokenTypeEnd;
    
    $tokenString = substr($buffer, $offset, 1);
    if ($quoteChar === $tokenString) {
      return new PhpCssScannerToken(
        $tokenTypeEnd, $quoteChar, $offset
      );
    }
    
    $tokenString = substr($buffer, $offset, 2);
    if ('\\' .$quoteChar === $tokenString ||
        '\\\\' === $tokenString) {
      return new PhpCssScannerToken(
        PhpCssScannerToken::STRING_ESCAPED_CHARACTER, $tokenString, $offset
      );
    }
    
    $tokenString = $this->matchPattern(
      $buffer, $offset, '([^\\\\'.$quoteChar.']+)S'
    );
    if (!empty($tokenString)) {
      return new PhpCssScannerToken(
        PhpCssScannerToken::STRING_CHARACTERS, $tokenString, $offset
      );
    }
    
    return NULL;
  }

  /**
  * Check if token ends status
  *
  * @param PhpCssScannerToken $token
  * @return boolean
  */
  public function isEndToken($token) {
    return (
      $token->type == $this->tokenTypeEnd
    );
  }

  /**
  * Get new (sub)status if needed.
  *
  * @param PhpCssScannerToken $token
  * @return NULL
  */
  public function getNewStatus($token) {
    return NULL;
  }
}