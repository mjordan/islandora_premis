<?php

namespace Drupal\islandora_premis\Controller;

use EasyRdf\Graph;
use Drupal\Core\Controller\ControllerBase;
use \Drupal\node\NodeInterface;
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
   public function main(NodeInterface $node) {

     // Allow modules to modify the PREMIS turtle output.
     \Drupal::moduleHandler()->invokeAll('islandora_premis_turtle_alter', [$node->id(), &$turtle]);

     // Create and serialize the graph, then send it to the client.
     $graph = new \EasyRdf\Graph();
     $graph->parse($turtle);
     $output = $graph->serialise('turtle');

     $response = new Response($output, 200);
     $response->headers->set("Content-Type", 'text/turtle');
     return $response;
   }

}
