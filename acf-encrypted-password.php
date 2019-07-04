<?php
/*
Plugin Name: Advanced Custom Fields: Encrypted Password
Plugin URI:  https://github.com/log1x/acf-encrypted-password
Description: A simple ACF field to use in place of the default Password field to encrypt the password stored in the database using PHP 5.5's password_hash.
Version:     1.0.3
Author:      Log1x
Author URI:  https://log1x.com

License:     MIT License
License URI: http://opensource.org/licenses/MIT
*/

namespace Log1x\Acf\EncryptedPassword;

if (class_exists('FieldLoader')) {
    return;
}

class FieldLoader
{
    public function __construct()
    {
        $this->settings = [
            'version'	=> '1.0.0',
            'url'		=> plugin_dir_url(__FILE__),
            'path'		=> plugin_dir_path(__FILE__)
        ];

        load_plugin_textdomain('acf-encrypted-password', false, plugin_basename(dirname(__FILE__ )) . '/lang');
        add_action('acf/include_field_types', [$this, 'field_types']);
        add_action('acf/register_fields', [$this, 'field_types']);
    }


    /**
     * Include our ACF Fields
     *
     * @return void
     */
    public function field_types()
    {
        include_once('fields/encrypted-password.php');
    }
}

new FieldLoader;
