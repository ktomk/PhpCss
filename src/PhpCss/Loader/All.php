<?php

$path = dirname(__FILE__) . '/..';

return array_merge(
  array(
  	'PhpCssAst' => $path.'/Ast.php',
    'PhpCssAstSelector' => $path.'/Ast/Selector.php',
  	'PhpCssAstSelectorCombination' => $path.'/Ast/Selector/Combination.php',
  	'PhpCssAstSelectorCombinationChild' => $path.'/Ast/Selector/Combination/Child.php',
  	'PhpCssAstSelectorCombinationDescendant' => $path.'/Ast/Selector/Combination/Descendant.php',
  	'PhpCssAstSelectorCombinationFollower' => $path.'/Ast/Selector/Combination/Follower.php',
  	'PhpCssAstSelectorCombinationGroup' => $path.'/Ast/Selector/Combination/Next.php',
  	'PhpCssAstSelectorGroup' => $path.'/Ast/Selector/Group.php',
  	'PhpCssAstSelectorSequence' => $path.'/Ast/Selector/Sequence.php',
  	'PhpCssAstSelectorSimple' => $path.'/Ast/Selector/Simple.php',
  	'PhpCssAstSelectorSimpleAttribute' => $path.'/Ast/Selector/Simple/Attribute.php',
  	'PhpCssAstSelectorSimpleClass' => $path.'/Ast/Selector/Simple/Class.php',
  	'PhpCssAstSelectorSimpleId' => $path.'/Ast/Selector/Simple/Id.php',
    'PhpCssAstSelectorSimplePseudo' => $path.'/Ast/Selector/Simple/Pseudo.php',
  	'PhpCssAstSelectorSimplePseudoNegation' => $path.'/Ast/Selector/Simple/Pseudo/Negation.php',
  	'PhpCssAstSelectorSimpleType' => $path.'/Ast/Selector/Simple/Type.php',
  	'PhpCssAstSelectorSimpleUniversal' => $path.'/Ast/Selector/Simple/Universal.php',
  	'PhpCssAstSelectorVisitor' => $path.'/Ast/Selector/Visitor.php',
  	'PhpCssException' => $path.'/Exception.php',
  	'PhpCssExceptionParser' => $path.'/Exception/Parser.php',
    'PhpCssExceptionTokenMismatch' => $path.'/Exception/TokenMismatch.php',
  	'PhpCssExceptionUnexpectedEndOfFile' => $path.'/Exception/UnexpectedEndOfFile.php',
    'PhpCssParser' => $path.'/Parser.php',
  ),
  include (dirname(__FILE__).'/Scanner.php')
);