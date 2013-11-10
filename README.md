SocialogShare
===========

Social media buttons module for Socialog

This module can be used without Socialog, it adds the following functions:

## Facebook button view helper

Adds a robots file on `/robots.txt` which can be configured using the module.config.php
so you can easily have different robots.txt in your development or production environment

```php
$this->facebookbutton(array(
    'data-layout'   => 'button_count',
    'share'         => false
));
```