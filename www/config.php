<?php

// use this config file to overwrite the defaults from default_config.php
// or to make local config changes.
$config = array();
// run the generator.php file or fill this with a long string
// must not be empty
$config['encryptionKey'] = '$2a$08$ZE.i9Oi/j.Bv8zsMCBy9POZb9GHyyJ/Hc15Dar/n8C6t3ZrIp6Ej2';

$config['site_title']     = 'WPLib'; // Site title
$config['theme']          = 'wplib'; // Set the theme

/*
 * Disable parsing the <?php in .md files
 */
$config['plugins']['phile\\parserMarkdown']['tab_width'] = 4;


/*
 * Turn off the cache
 */
$config['plugins']['phile\\phpFastCache']['active'] = false;


/*
 * It is important to return the $config array!
 */
return $config;
