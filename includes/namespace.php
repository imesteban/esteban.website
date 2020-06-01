<?php

/**
 * Namespaces
 */

// Contexts
require_once INCLUDES_DIR . '/contexts/namespace.php';

// Models
// require_once INCLUDES_DIR . '/models/namespace.php';

// Blocks
require_once INCLUDES_DIR . '/blocks/namespace.php';

// Wordpress
require_once INCLUDES_DIR . '/class-assets.php';
require_once INCLUDES_DIR . '/class-image-manager.php';
require_once INCLUDES_DIR . '/class-acf.php';
require_once INCLUDES_DIR . '/class-wordpress.php';
require_once INCLUDES_DIR . '/class-rest-api.php';


EDA\ACF::bootstrap();
EDA\Wordpress::bootstrap();
EDA\ImageManager::bootstrap();
EDA\Assets::bootstrap();
EDA\RestAPI::bootstrap();