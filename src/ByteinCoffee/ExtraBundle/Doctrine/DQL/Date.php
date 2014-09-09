<?php

namespace ByteinCoffee\ExtraBundle\Doctrine\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 * 
 * DateFunction ::= "DATE" "(" ArithmeticPrimary ")"
 */
class Date extends FunctionNode
{

    public $dateExpression = null;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return \sprintf('DATE(%s)', $this->dateExpression->dispatch($sqlWalker));
    }

}
