<?php
use Twig\Extension\AbstractExtension;
use Twig\TokenParser\AbstractTokenParser;
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
 * ZF Helper Extension for Twig's Zend Framework Integration
 * Handles some native ZF view helpers
 *
 * Inspired from Symfony 2 Twig Bundle
 *
 * @package     Ano_ZFTwig
 * @subpackage  Extension
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_Extension_HelperExtension extends AbstractExtension
{
    /**
     * Returns the token parser instance to add to the existing list.
     *
     * @return array An array of AbstractTokenParser instances
     */
    public function getTokenParsers()
    {
        return array(
            // {% headTitle 'My page title' %}
            new Ano_ZFTwig_TokenParser_HeadTitleTokenParser(),

            // {% javascript 'js/blog.js', {'mode': 'append', 'attrs': {'conditional': 'lt IE 7'}} %}
            new Ano_ZFTwig_TokenParser_JavascriptTokenParser(),

            // {% stylesheet 'css/blog.css', {'mode': 'append', 'media': 'screen', 'attrs': {'id': 'my_stylesheet'}} %}
            new Ano_ZFTwig_TokenParser_StylesheetTokenParser(),

            // {% meta, {'name': 'description', 'content': 'My super website SEO description'} %}
            // {% meta, {'http-equiv': 'Content-Type', 'content': 'text/html; charset=utf-8'} %}
            new Ano_ZFTwig_TokenParser_MetaTokenParser(),

            // {% hlp 'helper' with [with <arguments:array>] %}
            new Ano_ZFTwig_TokenParser_HelperTokenParser(),

            // {% layout 'content' %}
            new Ano_ZFTwig_TokenParser_LayoutTokenParser(),
        );
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'headTitle'    => new \Twig\TwigFunction('headTitle', array($this, 'getHeadTitle'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            )),
            'javascripts'  => new \Twig\TwigFunction('javascripts', array($this, 'getJavascripts'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            )),
            'stylesheets'  => new \Twig\TwigFunction('stylesheets', array($this, 'getStylesheets'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            )),
            'metas'  => new \Twig\TwigFunction('metas', array($this, 'getMetas'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            )),
            'url'  => new \Twig\TwigFunction('url', array($this, 'getUrl'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            )),
            'layoutBlock'  => new \Twig\TwigFunction('layoutBlock', array($this, 'getLayoutBlock'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            )),
        );
    }

    public function getHeadTitle(Environment $env)
    {
        return $env->getView()->headTitle();
    }

    public function getJavascripts(Environment $env)
    {
        return $env->getView()->headScript();
    }

    public function getStylesheets(Environment $env)
    {
        return $env->getView()->headLink();
    }

    public function getMetas(Environment $env)
    {
        return $env->getView()->headMeta();
    }

    public function getUrl(Environment $env, $name, array $parameters = array(), $reset = false, $encode = true)
    {
        return $env->getView()->url($parameters, $name, $reset, $encode);
    }

    public function getLayoutBlock(Environment $env, $name)
    {
        return $env->getView()->layout()->__get($name);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'helper';
    }
}
