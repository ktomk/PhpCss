<?php
/**
* PhpCss Scanner Status Comment
* 
* Copyright (c) 2009 Basitan Feder, Thomas Weinert
* Copyriǵht (c) 2010 Tom Klingenberg
* 
* Licensed under the MIT License, see license.txt
*
* @version $Id: Default.php 429 2010-03-29 08:05:32Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package PhpCss
* @subpackage Scanner
*/

/**
* PhpCss Scanner Status Comment recognizes token of a css comment / not-comment sequence.
*
* @package PhpCss
* @subpackage Scanner
*/
class PhpCssScannerStatusComment extends PhpCssScannerStatus {
  private $inComment = false;

 /**
  * patterns for tokens
  * @var array
  */
  protected $_tokenPatterns = array(
    PhpCssScannerToken::COMMENT_END => '(\*/)S',
 	PhpCssScannerToken::COMMENT_START => '(/\*)S',  
    array(PhpCssScannerToken::COMMENT_OUTER, '((.*?)(/\*))S', 1),
    array(PhpCssScannerToken::COMMENT_INNER, '((.*?)(\*/))S', 1),
    array(PhpCssScannerToken::COMMENT_OUTER, '(.*)S', 0),
  );
  
  /**
  * test for token at offset.
  *
  * @param string $buffer
  * @param integer $offset
  * @return FluentDOMSelectorCssToken
  */
  public function getToken($buffer, $offset) {  	
    ($token = $this->getTokenLookahead($buffer, $offset)) 
  	  || ($token = $this->getTokenConsumer($buffer, $offset))
  	  ;
  	$this->updateInComment($token);
  	return $token;
  }
  private function updateInComment($token) {
    if (NULL === $token)
      return;
  	/* @var $token PhpCssScannerToken */
  	$tokenType = $token->type;
  	if ($tokenType === PhpCssScannerToken::COMMENT_START) {
  	  $this->inComment = true;
  	} elseif($tokenType === PhpCssScannerToken::COMMENT_END) {
  	  $this->inComment = false;
  	}
  }
  /**
   * look ahead for next token
   */
  private function getTokenLookahead($buffer, $offset) {
    $token = NULL;
    if ($this->inComment) {
      $marker = '*/';
      $tokenType = PhpCssScannerToken::COMMENT_INNER;
    } else {
      $marker = '/*';
      $tokenType = PhpCssScannerToken::COMMENT_OUTER;      
    }
    $pos = strpos($buffer, $marker, $offset);
    
    if (false !== $pos) {
      $tokenLen = $pos - $offset;
      if ($tokenLen === 0) {
        $tokenLen = 2;
        $tokenType = $tokenType - 2;
      }
      $tokenString = substr($buffer, $offset, $tokenLen);
  	  $token = new PhpCssScannerToken(
          $tokenType, $tokenString, $offset
      );
    }
    return $token;
  }
  /**
   * get token that consumes the rest of the buffer
   */
  private function getTokenConsumer($buffer, $offset) {
    $tokenLen = strlen($buffer) - $offset;
    if (!$tokenLen) 
      return NULL;
    if ($this->inComment) {
      $tokenType = PhpCssScannerToken::COMMENT_INNER;
    } else {
      $tokenType = PhpCssScannerToken::COMMENT_OUTER;      
    }
    $tokenString = substr($buffer, $offset, $tokenLen);
  	$token = new PhpCssScannerToken(
      $tokenType, $tokenString, $offset
    );
    return $token;
  }
  private function getTokenOld($buffer, $offset) {
  	foreach ($this->_tokenPatterns as $key => $pattern) {
      if (is_array($pattern)) {
      	$index = $pattern[2];
      	$type = $pattern[0];
      	$pattern = $pattern[1];
      } else {
      	$index = 0;
      	$type = $key;
      }
      $tokenString = $this->matchSubpattern(
        $buffer, $offset, $pattern, $index
      );
      if (empty($tokenString)) {
      	continue;
      }
      $token = new PhpCssScannerToken(
          $type, $tokenString, $offset
      );
      $this->endTokenHash = spl_object_hash($token);
      break;
    }
    return $token;
  }

  /**
  * Check if token ends status
  *
  * @param PhpCssScannerToken $token
  * @return boolean
  */
  public function isEndToken($token) {
  	return false;
  }

  /**
  * Get new (sub)status if needed.
  *
  * @param PhpCssScannerToken $token
  * @return PhpCssScannerStatus
  */
  public function getNewStatus($token) {
    return NULL;
  }
}