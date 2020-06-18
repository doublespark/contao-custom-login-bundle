<?php

/**
 * Table tl_settings
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] =  str_replace
(
    '{security_legend:hide}',
    '{ds_customLogin_legend:show},dsCustomLoginTheme,dsCustomLoginEndpointUrl;{security_legend:hide}',
    $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
);

// Backwards compatibility with older versions of Contao
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] =  str_replace
(
    '{security_legend}',
    '{ds_customLogin_legend:show},dsCustomLoginTheme,dsCustomLoginEndpointUrl;{security_legend}',
    $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
);

// Fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['dsCustomLoginTheme'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_settings']['dsCustomLoginTheme'],
    'inputType' => 'radio',
    'default'   => 'default',
    'options'   => [
        'default' => 'Default',
        'ds'      => 'Doublespark',
        'tf'      => 'TitmanFirth'
    ],
    'eval'  => array('mandatory'=>true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dsCustomLoginEndpointUrl'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_settings']['dsCustomLoginEndpointUrl'],
    'inputType' => 'text',
    'eval'  => array('mandatory'=>true, 'rgxp' => 'url')
);