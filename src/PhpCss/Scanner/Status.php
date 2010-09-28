<?php
/**
* PhpCssScannerStatus is the abstract subperclass for all scanner status implementations
*
* Copyright (c) 2009 Bastian Feder, Thomas Weinert
* Copyright (c) 2010 Tom Klingenberg
* 
* Licensed under the MIT License, see license.txt
* 
* @version $Id: Status.php 429 2010-03-29 08:05:32Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package PhpCss
* @subpackage Scanner
*/

/**
* PhpCssScannerStatus is the abstract subperclass for all scanner status implementations
*
* @package PhpCss
* @subpackage Scanner
*/
abstract class PhpCssScannerStatus {

  /**
  * Try to get token in buffer at offset position.
  *
  * @param string $buffer
  * @param integer $offset
  * @return PhpCssScannerToken
  */
  abstract public function getToken($buffer, $offset);

  /**
  * Check if token ends status
  *
  * @param PhpCssScannerToken $token
  * @return boolean
  */
  abstract public function isEndToken($token);

  /**
  * Get new (sub)status if needed.
  *
  * @param PhpCssScannerToken $token
  * @return PhpCssScannerStatus
  */
  abstract public function getNewStatus($token);

  /**
  * Checks if the given offset position matches the pattern.
  *
  * @param string $buffer
  * @param integer $offset
  * @param string|array $pattern
  * @param integer $group (optional) backreference, standard is 0
  * @return string|NULL text of pattern or NULL if no match
  */
  public function matchPattern($buffer, $offset, $pattern) {
  	$index = 0;
  	if(is_array($pattern)) {
  		$index = array_pop($pattern);
  		$pattern = reset($pattern);
  	}
  	return $this->matchOffset($buffer, $offset, $pattern, $index);
  }
  /**
   * Checks if the given offset position matches the pattern and
   * return a specific subpattern match.
   * 
   * @param string $buffer
   * @param integer $offset
   * @param string $pattern
   * @param integer $index
   * @param string|NULL$index
   */
  public function matchSubpattern($buffer, $offset, $pattern, $index) {
  	return $this->matchOffset($buffer, $offset, $pattern, $index);
  }
  private function matchOffset($buffer, $offset, $pattern, $index) {
  	$return = NULL;
    $found = preg_match(
      $pattern, $buffer, $match, PREG_OFFSET_CAPTURE, $offset
    );
    if (false === $found) {
    	$error = preg_last_error();
    	throw new UnexpectedValueException(sprintf('Regular expression ("%s") failed (Error-Code: %d).', $pattern, $error));
    }
	$found
      && isset($match[$index][1])
      && $match[$index][1] === $offset
      && $return = $match[$index][0]
	;
    return $return;
  }
}
