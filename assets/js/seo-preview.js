/*global $: false, $$: false, Class: false, Backend: false, Request: false, Element: false, title: false, url: false, description: false, suffix:false, base:false, lang:false */

/**
 * @package   SerPreview
 * @author    Wolfgang Schwaiger <wolfgang.schwaiger@qualitywork.at>
 * @license   LGPLv3
 * @copyright quality work | clever.simple.effective.
 */

var SerPreview = new Class({
    init: function ($title, $url, $description) {
        'use strict';
        
        var self = this,
            container = new Element('div', {
                'id': 'google-preview',
                'class': 'google-preview'
            }),
            title = new Element('span#google__title.google__title'),
            url = new Element('div#google__url.google__url'),
            description = new Element('div#google__description.google__description');
        /* hide text field */
        $('ctrl_google').hide();
        
        /* get data from title, description fields */
        description.appendText($description.substring(0, 160));
        title.appendText($title.substring(0, 70));
        url.appendText($url);
        
        /* append preview fields */
        title.inject(container);
        url.inject(container);
        description.inject(container);
        
        container.inject($('ctrl_google'), 'after');
    },
    formatString: function ($str, $length, $orig) {
        'use strict';
        
        /* format the string for the max length of charactars */
        if ($str.length > $length) {
            return $str.substring(0, $length) + "...";
        } else if ($str.length === 0) {
            return $orig;
        } else {
            return $str;
        }
    },
    fillValues: function () {
        'use strict';
        
        var alias = $('ctrl_alias').value;
        
        $('google__title').set('text', this.formatString($('ctrl_pageTitle').value, 70, title));
        $('google__description').set('text', this.formatString($('ctrl_description').value, 160, description));
        /* rebuild the url */
        $('google__url').set('text', base + lang + alias + suffix);
    },
    initChangeEvents: function () {
        'use strict';
        
        $$('#ctrl_pageTitle, #ctrl_description, #ctrl_alias').addEvents({
            'keyup': function () {
                SerPreview.prototype.fillValues();
            }
        });
    }
}),
    serp = new SerPreview();

/* init the awesome */
if (window.MooTools) {
    window.addEvent('domready', function () {
        'use strict';
        
        serp.init(title, url, description);
        serp.fillValues();
        serp.initChangeEvents();
    });
}