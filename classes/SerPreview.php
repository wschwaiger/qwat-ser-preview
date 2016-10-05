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


/**
 * Namespace
 */
namespace SerPreview;

/**
 * Class SerPreview
 *
 * @copyright  quality work | clever.simple.effective.
 * @author     Wolfgang Schwaiger <wolfgang.schwaiger@qualitywork.at>
 * @package    Devtools
 */
class SerPreview extends \Backend
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = '';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        return '';
    }
    
    public function loadJS($strContent, $strTemplate)
    {
        /* only activate when a page is opend to edit */
        if ($strTemplate == 'be_main' && \Input::get('id') && \Input::get('do') == 'page') {
            $lang = '';
            /* generate page url */
            $pageModel = \PageModel::findByPK(\Input::get('id'));

            if ($pageModel) {
                $url = \Controller::generateFrontendUrl($pageModel->row());
            }
            /* check if the language should be added to the url by configuration */
            if (\Config::get('addLanguageToUrl') && \Config::get('rewriteURL')) {
                // both options are enabled. example: "de/home.html"
                $lang = substr($url, 0, 3);
            } elseif (\Config::get('addLanguageToUrl') && !\Config::get('rewriteURL')) {
                // example: "index.php/en/home.html"
                $lang = substr($url, 0, 13);
            } elseif (!\Config::get('addLanguageToUrl') && !\Config::get('rewriteURL')) {
                // both options are disabled. example: "index.php/home.html"
                $lang = substr($url, 0, 10);
            } else {
                $lang = "";
            }
            
            /* prepare code to be inserted */
            $javascript = '<script>' .
                'var url = "'       . $this->Environment->base . $url . '",' .
                'description = "'   . $GLOBALS['TL_LANG']['tl_page']['serp_description'] . '",' .
                'title = "'         . $GLOBALS['TL_LANG']['tl_page']['serp_title'] . '",' .
                'base = "'          . $this->Environment->base . '",' .
                'lang = "'          . $lang . '",' .
                'suffix = "'        . \Config::get('urlSuffix') . '";' .
                file_get_contents('../' . SER_PREVIEW_PATH . '/assets/js/seo-preview.js') . '</script>';
            
            /* fabricate css information */
            $css = '<style>' . file_get_contents('../' . SER_PREVIEW_PATH . '/assets/css/seo-preview.css') . '</style>';
            
            /* insert right before the closing <body> tag */
            $strContent = str_replace('</body>', $javascript . $css . '</body>', $strContent);
        }

        return $strContent;
    }
}
