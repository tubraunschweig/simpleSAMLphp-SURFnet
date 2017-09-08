# Introduction

This project is based on the [SURFnet theme](https://github.com/SURFnet/simpleSAMLphp-SURFnet) for simpleSAMLphp.

The module can be installed in simpleSAMLphp by copying it into the `modules` directory.

# License
As this module takes code from simpleSAMLphp which is licensed under the LGPLv2
this module has the same license. See included `COPYING` file.

# Installation
We assume simpleSAMLphp is installed in `/var/www/simplesamlphp`, see the
[installation instructions](http://simplesamlphp.org/docs/stable/simplesamlphp-install). 

You can install this theme as follows:

    $ cd /var/www/simplesamlphp/modules
    $ git clone https://github.com/tubraunschweig/simpleSAMLphp-TU-BS tu-bs-theme

Now you can edit the main configuration file to enable the theme, change the
following line in `/var/www/simplesamlphp/config/config.php`:

    'theme.use'             => 'default',

Into:

    'theme.use'             => 'tu-bs-theme:tu-bs-design',

This should enable the theme. You can only see it in action when there is an
actual login screen with username and password dialog.

# Customization
Replace `logo.svg` with your own logo. You can customize the page background color in `tu-bs-design/www/resources/style.css`.
