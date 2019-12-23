<?php

/**
 * @file
 * Hooks for the Islandora PREMIS Integration module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter the serialized Turtle.
 *
 * Implementations should use EasyRdf or another Turtle library
 * instead of manually altering the Turtle.
 *
 * @param string $nid
 *   The current node's ID.
 * @param string $turtle
 *   The serialized Turtle.
 */
function hook_islandora_premis_turtle_alter($nid, &$turtle) {
  $current_path = \Drupal::service('path.current')->getPath();
  $path_args = explode('/', ltrim($current_path, '/'));
  if (count($path_args) == 3 && $path_args[0] == 'node' && $path_args[2] == 'premis') {
    $nid = $path_args[1];
    $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
  }
  if (!$node) {
    return array();
  }

  $base_url = \Drupal::request()->getSchemeAndHttpHost();
  $resource = $base_url . '/node/' . $nid;
  $url = $base_url . '/node/' . $nid . "?_format=jsonld";
  $graph = EasyRdf_Graph::newAndLoad($url);
  $graph->addType($resource, "http://www.loc.gov/premis/rdf/v3/IntellectualEntity");
  $data = $graph->serialise('turtle');
  $turtle .= $data;
}

/**
 * @} End of "addtogroup hooks".
 */
