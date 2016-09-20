<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @package   SerPreview
 * @author    Wolfgang Schwaiger <wolfgang.schwaiger@qualitywork.at>
 * @license   LGPLv3
 * @copyright quality work | clever.simple.effective.
 */

define(SER_PREVIEW_VERSION, '1.0.0');
define(SER_PREVIEW_PATH, 'system/modules/qwat-ser-preview');
$GLOBALS['SER_PREVIEW']['whiteList'] = array(
    'regular'
);

/**
 * HOOKS
 *
 * Hooks are stored in a global array called "TL_HOOKS". You can register your
 * own functions by adding them to the array.
 *
 * $GLOBALS['TL_HOOKS'] = array
 * (
 *    'hook_1' => array
 *    (
 *       array('MyClass', 'myPostLogin'),
 *       array('MyClass', 'myPostLogout')
 *    )
 * );
 *
 * Hooks allow you to add functionality to the core without having to modify the
 * source code by registering callback functions to be executed on a particular
 * event. For more information see https://contao.org/manual.html.
 */
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array('SerPreview', 'loadJS');
