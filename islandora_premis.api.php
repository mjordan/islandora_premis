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
 * @param string $nid
 *   The current node's ID.
 * @param string $turtle
 *   The serialized Turtle.
 */
function hook_islandora_premis_turtle_alter($nid, &$turtle) {
  $prefix = '@prefix crypHashFunc: <http://id.loc.gov/vocabulary/preservation/cryptographicHashFunctions/> .' . "\n" .
    '@prefix evOutcome: <http://id.loc.gov/vocabulary/preservationevOutcome/> .' . "\n";
  $statement = "\n" . '<0912-0001Fixity> a crypHashFunc:sha256 ;
    rdf:value "a9ccb64f06f9c7098b76ac4a51074fd285b48f4b248857221f82111a1656d193" ;
    dce:creator "hashlib.sha256" .' . "\n";
  $turtle = $prefix . $turtle . $statement;
}

/**
 * @} End of "addtogroup hooks".
 */
