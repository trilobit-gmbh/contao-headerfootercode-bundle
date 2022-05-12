<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-calculator-bundle
 */

// legends
$GLOBALS['TL_LANG']['tl_page']['headerfootercode_legend'] = 'Header and footer code settings';

// fields
$GLOBALS['TL_LANG']['tl_page']['hfc_header'][0] = 'Additional header code';
$GLOBALS['TL_LANG']['tl_page']['hfc_header'][1] = 'Here you can enter any additional header code. This can be meta data, .js, or .css code, or anything you like.';
$GLOBALS['TL_LANG']['tl_page']['hfc_footer'][0] = 'Additional footer code';
$GLOBALS['TL_LANG']['tl_page']['hfc_footer'][1] = 'Here you can enter any additional footer code. The footer code will be embedded after closing of WRAPPER div together with the theme\'s jQuery-, MooTools- and JavaScripts.';
$GLOBALS['TL_LANG']['tl_page']['hfc_inheritance'][0] = 'Inherit code';
$GLOBALS['TL_LANG']['tl_page']['hfc_inheritance'][1] = 'Select Yes to inherit the header and footer code on subpages. With the option No, the header and footer code will only be embedded on the current page.';
$GLOBALS['TL_LANG']['tl_page']['hfc_mode'][0] = 'Embedded method';
$GLOBALS['TL_LANG']['tl_page']['hfc_mode'][1] = 'The embedding method determines whether only the current header and footer code should be embedded or all header and footer code to be inherited should be embedded.';

// options
$GLOBALS['TL_LANG']['tl_page']['hfc_options']['inheritance'][0] = 'no';
$GLOBALS['TL_LANG']['tl_page']['hfc_options']['inheritance'][1] = 'yes';
$GLOBALS['TL_LANG']['tl_page']['hfc_options']['mode'][0] = 'Embed everything - including inherited header and footer code';
$GLOBALS['TL_LANG']['tl_page']['hfc_options']['mode'][1] = 'Embed only the current header and footer code';
