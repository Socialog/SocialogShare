<?php

namespace SocialogShare;

use SocialogShare\View\Helper\Facebook;
use Zend\View\HelperPluginManager;

return [
    'factories' => [
        'facebookbutton' => function(HelperPluginManager $sm) {
            $sl = $sm->getServiceLocator();
            return new Facebook();
        }
    ]
];