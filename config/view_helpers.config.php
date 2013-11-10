<?php

namespace SocialogShare;

use SocialogShare\View\Helper\Facebook;
use SocialogShare\View\Helper\Twitter;
use Zend\View\HelperPluginManager;

return [
    'factories' => [
        'facebookbutton' => function(HelperPluginManager $sm) {
            return new Facebook();
        },
        'twitterbutton' => function(HelperPluginManager $sm) {
            return new Twitter();
        }
    ]
];