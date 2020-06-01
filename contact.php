<?php

/**
 * Template Name: Contact
 */

use EDA\Contexts\ContactContext;

$context = ContactContext::get_context();

Timber::render( 'templates/contact.twig', $context );