<?php

use EasyRdf\Graph;

namespace Drupal\islandora_premis\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
* Controller.
*/
class IslandoraPremisPremisController extends ControllerBase {
  public function __construct() {
  }

  /**
   * @return Response object
   */
   public function main() {
     $current_path = \Drupal::service('path.current')->getPath();
     $path_args = explode('/', $current_path);
     $nid = $path_args[2];

     // Allow modules to modify the PREMIS turtle output.
     \Drupal::moduleHandler()->invokeAll('islandora_premis_turtle_alter', [$nid, &$turtle]);

     // Create and serialize the graph, then send it to the client.
     $graph = new \EasyRdf\Graph();
     $graph->parse($turtle);
     $output = $graph->serialise('turtle');
     
     $response = new Response($output, 200);
     $response->headers->set("Content-Type", 'text/turtle');
     return $response;
   }

}

