<?php

/**
 * Update routing table after route change.
 */
function islandora_premis_post_update_permissions_fix_clear_route() {
  \Drupal::service("router.builder")->rebuild();
}
