<?php

namespace SocialogShare\View\Helper;

use Zend\Stdlib\ArrayUtils;
use Zend\View\Helper\AbstractHelper;

class Twitter extends AbstractHelper
{
    /**
     * If the button is already included somewhere, else dont insert the tag twice
     */
    protected $included = false;

    protected $defaults = array(
        'class'         => 'twitter-share-button',
        'href'          => 'https://twitter.com/share',
        'data-hashtags' => '',
        'data-via'      => '',
    );

    /**
     * Call to make sure the needed script is included in the page
     */
    public function ensureScriptIncluded()
    {
        if ($this->included) return;

        $script = <<<SCRIPT
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
SCRIPT;
        $this->getView()->inlineScript()->appendScript($script);
        $this->included = true;
    }

    /**
     * @param array $options
     * @return string
     */
    public function __invoke(array $options = array())
    {
        $this->ensureScriptIncluded();

        $defaults = $this->defaults;
        $defaults['data-url'] = $this->getView()->serverUrl(true);

        $options = array_merge($defaults, $options);

        $attributes = array();
        foreach ($options as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? "true" : "false";
            }
            $attributes[] = "$key=\"$value\"";
        }

        return "<div " . implode(" ", $attributes) . "></div>";
    }
}
