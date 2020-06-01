<?php

/**
 * Template Name: Homepage
 */

use EDA\Assets;
use EDA\Contexts\HomepageContext;

// Scripts, libraries, stylesheets
Assets::load_aos_library();

$context = HomepageContext::get_context();

Timber::render( 'templates/homepage.twig', $context );