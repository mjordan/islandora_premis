<?php

/**
 * @file
 * Post update hooks.
 */

/**
 * Implements hook_post_update_NAME().
 */
function islandora_premis_post_update_permissions_fix_clear_route() {
  \Drupal::service("router.builder")->rebuild();
}
