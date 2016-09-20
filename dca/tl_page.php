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

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'ser_preview';

if (TL_MODE == 'BE') {
    if (!is_array($GLOBALS['SER_PREVIEW']['whiteList'])) {
        $GLOBALS['SER_PREVIEW']['whiteList'] = array();
    }

    foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $type => $palette) {
        if (in_array($type, $GLOBALS['SER_PREVIEW']['whiteList']) && $type != '__selector__') {
            $GLOBALS['TL_DCA']['tl_page']['palettes'][$type] = str_replace(
                'robots,description',
                'robots,description;{ser_preview_legend},google;',
                $GLOBALS['TL_DCA']['tl_page']['palettes'][$type]
            );
        }
    }
}

$GLOBALS['TL_DCA']['tl_page']['fields']['google'] = array
(
    'label'        => &$GLOBALS['TL_LANG']['tl_page']['google'],
    'exclude'      => true,
    'inputType'    => "checkbox",
    'sql'          => "char(1) NOT NULL default ''"
);
