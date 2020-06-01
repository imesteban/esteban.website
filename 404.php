<?php

/**
 * 404
 */

use EDA\Contexts\SimpleContext;

$context = SimpleContext::get_context();

Timber::render( 'templates/404.twig', $context );