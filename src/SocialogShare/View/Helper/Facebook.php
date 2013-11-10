<?php

namespace SocialogShare\View\Helper;

use Zend\Stdlib\ArrayUtils;
use Zend\View\Helper\AbstractHelper;

class Facebook extends AbstractHelper
{
    /**
     * If the button is already included somewhere, else dont insert the tag twice
     */
    protected $included = false;

    /**
     * @type \Zend\Http\PhpEnvironment\Request
     */
    protected $request;

    protected $defaults = array(
        'class'         => 'fb-like',
        'data-layout'        =>  'standard',
        'data-action'        => 'like',
        'data-show-faces'   => false,
        'data-share'         => true,
    );

//    /**
//     * @param \Zend\Http\PhpEnvironment\Request
//     */
//    public function __construct(Request $request)
//    {
//        $this->request = $request;
//    }

    public function ensureScriptIncluded()
    {
        if ($this->included) return;

        $script = <<<SCRIPT
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
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
        $defaults['data-href'] = $this->getView()->serverUrl(true);

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
