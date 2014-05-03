blogwerk/oop-theme-example
========================

## Installation

use this composer.json to install a complete wordpress with the theme and its dependencies:
```javascript
{
  "name": "blogwerk/oop-project",

  "type": "project",

  "repositories" : [
    {
      "type" : "composer",
      "url"  : "http://rarst.net"
    }
  ],

  "require": {
    "rarst/wordpress" : ">=3.9",
    "composer/installers": "~1.0",
    "johnpbloch/wordpress-core-installer": "~0.1",
    "blogwerk/oop-theme-example": "dev-master"
  },

  "minimum-stability": "dev",

  "extra": {
    "wordpress-install-dir": ".",
    "installer-paths": {
      "wp-content/plugins/{$name}": ["type:wordpress-plugin"],
      "wp-content/themes/{$name}": ["type:wordpress-theme"]
    }
  }
}
```

and then run:
```bash
composer install
```