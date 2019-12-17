<?php

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

     // Allow other modules to modify $config_file_contents before it is POSTed to the microservice.
     $turtle = '@prefix premis: <http://www.loc.gov/premis/rdf/v3/> .' . "\n";
     \Drupal::moduleHandler()->invokeAll('islandora_premis_turtle_alter', [$nid, &$turtle]);

     $output = "\n";
     $output .= $turtle;

     $response = new Response($output, 200);
     $response->headers->set("Content-Type", 'text/turtle');
     return $response;
   }

}

