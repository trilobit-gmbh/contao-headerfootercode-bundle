<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-calculator-bundle
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('headerfootercode_legend', 'protected_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField(['hfc_header', 'hfc_footer', 'hfc_inheritance,hfc_mode'], 'headerfootercode_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('regular', 'tl_page')
;

PaletteManipulator::create()
    ->addLegend('headerfootercode_legend', 'meta_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField(['hfc_header', 'hfc_footer', 'hfc_inheritance,hfc_mode'], 'headerfootercode_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('root', 'tl_page')
    ->applyToPalette('rootfallback', 'tl_page')
;

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_header'] = [
    'exclude' => true,
    'inputType' => 'textarea',
    'eval' => ['tl_class' => 'long clr', 'preserveTags' => true, 'decodeEntities' => false, 'allowHtml' => true, 'rte' => 'ace|html'],
    'sql' => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_footer'] = [
    'exclude' => true,
    'inputType' => 'textarea',
    'eval' => ['tl_class' => 'long clr', 'preserveTags' => true, 'decodeEntities' => false, 'allowHtml' => true, 'rte' => 'ace|html'],
    'sql' => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_inheritance'] = [
    'exclude' => true,
    'default' => 1,
    'inputType' => 'select',
    'options' => [0, 1],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['hfc_options']['inheritance'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_mode'] = [
    'exclude' => true,
    'default' => 1,
    'inputType' => 'select',
    'options' => [0, 1],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['hfc_options']['mode'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => "char(1) NOT NULL default ''",
];
