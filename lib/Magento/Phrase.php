<?php
/**
 * Phrase (for replacing Data Value with Object)
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento;

class Phrase
{
    /**
     * Default phrase renderer. Allows stacking renderers that "don't know about each other"
     *
     * @var \Magento\Phrase\RendererInterface
     */
    private static $_renderer;

    /**
     * String for rendering
     *
     * @var string
     */
    private $_text;

    /**
     * Arguments for placeholder values
     *
     * @var array
     */
    private $_arguments;

    /**
     * Set default Phrase renderer
     *
     * @param \Magento\Phrase\RendererInterface $renderer
     */
    public static function setRenderer(\Magento\Phrase\RendererInterface $renderer)
    {
        self::$_renderer = $renderer;
    }

    /**
     * Phrase construct
     *
     * @param string $text
     * @param array $arguments
     */
    public function __construct($text, array $arguments = array())
    {
        $this->_text = (string)$text;
        $this->_arguments = $arguments;
    }

    /**
     * Render phrase
     *
     * @return string
     */
    public function render()
    {
        return self::$_renderer ? self::$_renderer->render($this->_text, $this->_arguments) : $this->_text;
    }

    /**
     * Defers rendering to the last possible moment (when converted to string)
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}