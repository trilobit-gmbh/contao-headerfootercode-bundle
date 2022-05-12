<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-calculator-bundle
 */

use Trilobit\HeaderfootercodeBundle\EventListener\ParseTemplateListener;

$GLOBALS['TL_HOOKS']['parseTemplate'][] = [ParseTemplateListener::class, '__invoke'];
