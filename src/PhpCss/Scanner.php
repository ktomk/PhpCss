<?php
/**
* PhpCssScanner scans a string for tokens.
*
* Copyright (c) 2010 Bastian Feder, Thomas Weinert
* Copyright (c) 2010 Tom Klingenberg
* 
* Licensed under the MIT License, see license.txt
* 
* @version $Id: Scanner.php 429 2010-03-29 08:05:32Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2010 Bastian Feder, Thomas Weinert
*
* @package PhpCss
* @subpackage Scanner
*/

/**
* The PhpCssScanner scans a string for tokens.
*
* The actual result depends on the status, the status
* class does the actual token matching and generation, the scanner handles, to loops and
* delegations.
*
* @package PhpCss
* @subpackage Scanner
*/
class PhpCssScanner {

  /**
  * Scanner status object
  * @var PhpCssScannerStatus
  */
  private $_status = NULL;
  /**
  * string to parse
  * @var string
  */
  private $_buffer = '';
  /**
  * current offset
  * @var interger
  */
  private $_offset = 0;

  /**
  * Constructor, set status object
  *
  * @param PhpCssScannerStatus $status
  */
  public function __construct(PhpCssScannerStatus $status) {
    $this->_status = $status;
  }

  /**
  * Scan a string for tokens
  *
  * @param array $target token target
  * @param string $string content string
  * @param integer $offset (optional) start offset
  * @return integer new offset
  */
  public function scan(&$target, $string, $offset = 0) {
    $this->_buffer = $string;
    $this->_offset = $offset;
    while ($token = $this->_next()) {
      $target[] = $token;
      // switch back to previous scanner
      if ($this->_status->isEndToken($token)) {
        return $this->_offset;
      }
      // check for status switch
      if ($newStatus = $this->_status->getNewStatus($token)) {
        // delegate to subscanner
        $this->_offset = $this->_delegate($target, $newStatus);
      }
    }
    if ($this->_offset < strlen($this->_buffer)) {
      $this->throwInvalidCharException($target);
    }
    return $this->_offset;
  }
  
  private function throwInvalidCharException() {
    $char = substr($this->_buffer, $this->_offset, 1);
    $bufferLen = strlen($this->_buffer);
    if ( 30 > $bufferLen) {
      $buffer = $this->_buffer;
    } else {
      $buffer = substr($this->_buffer, 0, 12);
      $buffer .= ' ... ';
      $buffer .= substr($this->_buffer, -12);
    }
    $status = get_class($this->_status);
    if ('PhpCssScannerStatus' === substr($status, 0, 19)) {
    	$status = substr($status, 19);
    }
    throw new UnexpectedValueException(
      sprintf(
        'Invalid char "%s" for status "%s" at offset #%d in "%s" (length: #%d)',
        $char,
        $status,
        $this->_offset,
        $buffer,
        strlen($this->_buffer)
      )
    );
  }

  /**
  * Get next token
  *
  * @return PhpCssScannerToken|NULL
  */
  private function _next() {
    if (($token = $this->_status->getToken($this->_buffer, $this->_offset)) &&
        $token->length > 0) {
      $this->_offset += $token->length;
      return $token;
    }
    return NULL;
  }

  /**
  * Got new status, delegate to subscanner.
  *
  * If the status returns a new status object, a new scanner is created to handle it.
  *
  * @param array $target
  * @param PhpCssStatus $status
  * @return PhpCssScanner
  */
  private function _delegate(&$target, $status) {
    $scanner = new self($status);
    return $scanner->scan($target, $this->_buffer, $this->_offset);
  }
}