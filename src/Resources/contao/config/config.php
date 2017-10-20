<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('Trilobit\HeaderfootercodeBundle\HeaderFooterCode', 'add');
