<?php

$path = dirname(dirname(__FILE__));

return array(
  'PhpCssScanner' => $path.'/Scanner.php',
  'PhpCssScannerStatus' => $path.'/Scanner/Status.php',
  'PhpCssScannerStatusComment' => $path.'/Scanner/Status/Comment.php',
  'PhpCssScannerStatusSelector' => $path.'/Scanner/Status/Selector.php',
  'PhpCssScannerStatusSelectorAttribute' => $path.'/Scanner/Status/Selector/Attribute.php',
  'PhpCssScannerStatusStringDouble' => $path.'/Scanner/Status/String/Double.php',
  'PhpCssScannerStatusStringSingle' => $path.'/Scanner/Status/String/Single.php',
  'PhpCssScannerToken' => $path.'/Scanner/Token.php',
);