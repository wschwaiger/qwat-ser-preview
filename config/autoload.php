<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'SerPreview',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'SerPreview\SerPreview' => 'system/modules/qwat-ser-preview/classes/SerPreview.php',
));
