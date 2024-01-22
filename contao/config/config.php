<?php

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['parseTemplate'][] = ['Doublespark\ContaoCustomLoginBundle\Hooks\TemplateHooks', 'onParseTemplate'];

/**
 * Default config
 */
$GLOBALS['TL_CONFIG']['dsCustomLoginTheme']          = 'default';
$GLOBALS['TL_CONFIG']['dsCustomLoginEndpointUrl']    = 'https://www.doublespark.co.uk/clm/v1.0/messages';
$GLOBALS['TL_CONFIG']['dsCustomLoginRemoteMessages'] = false;