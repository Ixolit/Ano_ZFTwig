<?php
use Twig\Parser;
use Twig\Compiler;
use Twig\Lexer;
use Twig\Loader\LoaderInterface;
use Twig\Environment;

/**
 * This file is part of the Ano_ZFTwig package
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @copyright  Copyright (c) 2010-2011 Benjamin Dulau <benjamin.dulau@gmail.com>
 * @license    New BSD License
 */

/**
 * Twig environment for Zend Framework 1.1x
 *
 * @package     Ano_ZFTwig
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_Environment extends Environment
{
    /**
     * @var Zend_View_Interface
     */
    protected $view;

    /**
     * @param Zend_View_Interface    $viw     A Zend Framework view object
     * @param LoaderInterface   $loader  A LoaderInterface instance
     * @param array                  $options An array of options
     * @param Lexer    $lexer   A Lexer instance
     * @param Parser   $parser  A Parser instance
     * @param Compiler $compiler A Compiler instance
     *
     * @see Twig\Environment::__construct()
     */
    public function __construct(Zend_View_Interface $view, LoaderInterface $loader = null, $options = array(), Lexer $lexer = null, Parser $parser = null, Compiler $compiler = null)
    {
        $this->setView($view);
        parent::__construct($loader, $options, $lexer, $parser, $compiler);
    }

    /**
     * Returns the view
     *
     * @return Zend_View_Interface
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Sets the view
     *
     * @param Zend_View_Interface $view
     * @return Ano_ZFTwig_Environment
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
        return $this;
    }
}
