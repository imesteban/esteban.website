<?php

/**
 * Default page
 */

use EDA\Contexts\PageContext;

$context = PageContext::get_context();

Timber::render( 'templates/page.twig', $context );