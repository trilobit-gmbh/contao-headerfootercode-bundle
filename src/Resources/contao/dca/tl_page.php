<?php

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace
(
    '{protected_legend',
    '{headerfootercode_legend},hfc_header,hfc_footer,hfc_inheritance,hfc_mode;{protected_legend',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']
);

$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace
(
    '{dns_legend',
    '{headerfootercode_legend},hfc_header,hfc_footer,hfc_inheritance;{dns_legend',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);

$GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'] = str_replace
(
    '{dns_legend',
    '{headerfootercode_legend},hfc_header,hfc_footer,hfc_inheritance;{dns_legend',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback']
);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_header'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['hfc_header'],
    'exclude'       => true,
    'inputType'     => 'textarea',
    'eval'          => array('tl_class'=>'long clr', 'preserveTags'=>true, 'decodeEntities'=>false, 'allowHtml'=>true, 'rte'=>'ace|html',),
    'sql'           => 'blob NULL',
);

$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_footer'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['hfc_footer'],
    'exclude'       => true,
    'inputType'     => 'textarea',
    'eval'          => array('tl_class'=>'long clr', 'preserveTags'=>true, 'decodeEntities'=>false, 'allowHtml'=>true, 'rte'=>'ace|html',),
    'sql'           => 'blob NULL',
);

$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_inheritance'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['hfc_inheritance'],
    'exclude'       => true,
    'default'       => 1,
    'inputType'     => 'select',
    'options'       => array(0, 1),
    'reference'     => $GLOBALS['TL_LANG']['tl_page']['hfc_options']['inheritance'],
    'eval'          => array('tl_class'=>'w50',),
    'sql'           => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['hfc_mode'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['hfc_mode'],
    'exclude'       => true,
    'default'       => 1,
    'inputType'     => 'select',
    'options'       => array(0, 1),
    'reference'     => $GLOBALS['TL_LANG']['tl_page']['hfc_options']['mode'],
    'eval'          => array('tl_class'=>'w50',),
    'sql'           => "char(1) NOT NULL default ''",
);
