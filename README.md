*NOTE:* This module is forked until - https://www.drupal.org/node/2863718#comment-12057925 - is merged into the 2.x branch on d.o

This module allows headers to be added, updated or removed through configuration with a particular focus on security and performance headers.

By default the following HTTP header configurations are set:

* Content-Security-Policy
* Strict-Transport-Security
* Public-Key-Pins
* Access-Control-Allow-Origin
* X-Xss-Protection
* X-Frame-Options
* X-Content-Type-Options

Please install the module and configure it here `/admin/config/system/response-headers`.
