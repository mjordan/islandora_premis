# Islandora PREMIS

## Introduction

A Drupal 8/9 module that serializes PREMIS metadata generated by various Islandora modules and microsrevices, including Islandora, JSON-LD, and Riprap. This module produces PREMIS v3 in Turtle RDF for a node by appending `/premis` to the end of the node's URL, e.g., `https://localhost/node/250/premis`.

Feedback on what PREMIS entities and events you'd like to see in this output is welcome.

Output will look like this:

```
@prefix premisobject: <http://www.loc.gov/premis/rdf/v3/Object> .
@prefix premis: <http://id.loc.gov/vocabulary/preservation/eventOutcome> .
@prefix ebucore: <https://www.ebu.ch/metadata/ontologies/ebucore#> .
@prefix cryphashfunc: <http://id.loc.gov/vocabulary/preservation/cryptographicHashFunctions/> .
@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix dc: <http://purl.org/dc/terms/> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
@prefix schema: <http://schema.org/> .

<http://127.0.0.1:8080/fcrepo/rest/2019-12/Evaluation and Effectiveness of Digital Preservation.pdf>
  a premisobject:File ;
  premis:size "534450" ;
  premis:compositionLevel 0 ;
  ebucore:hasMimeType "application/pdf" ;
  premis:fixity "7b44c786-6d7e-4764-b278-d1ac1d503d99", "324bd1b9-0a38-400d-bd07-2026801e1040", "458f3e38-34c8-412d-879f-0ec3c5a1c37c", "eb7951ac-3baf-4661-a181-76ef0995744b", "d3e39c84-ae5d-44bb-b8ce-fbe9289b1f31" .

<7b44c786-6d7e-4764-b278-d1ac1d503d99>
  a <http://id.loc.gov/vocabulary/preservation/eventType/fix>, cryphashfunc:sha256 ;
  rdf:value "6933a46f55f27a62689406ea33c650b1c16d6268ee81f6c6a2a89c63aeec9d27" ;
  dc:created "2019-12-21T15:41:00-0600" ;
  premis:outcome "success" .

<http://localhost:8000/node/1>
  a <http://pcdm.org/models#Object>, <https://schema.org/DigitalDocument>, <http://www.loc.gov/premis/rdf/v3/IntellectualEntity> ;
  dc:extent "1 item"^^xsd:string ;
  dc:title "A document!"@en ;
  schema:author <http://localhost:8000/user/1> ;
  schema:dateCreated "2019-12-09T14:39:07+00:00"^^xsd:dateTime ;
  schema:dateModified "2019-12-09T14:41:25+00:00"^^xsd:dateTime ;
  schema:sameAs <http://localhost:8000/node/1> .

<http://localhost:8000/user/1> a schema:Person .
<324bd1b9-0a38-400d-bd07-2026801e1040>
  a <http://id.loc.gov/vocabulary/preservation/eventType/fix>, cryphashfunc:sha256 ;
  rdf:value "6933a46f55f27a62689406ea33c650b1c16d6268ee81f6c6a2a89c63aeec9d27" ;
  dc:created "2019-12-22T11:44:31-0600" ;
  premis:outcome "success" .

<458f3e38-34c8-412d-879f-0ec3c5a1c37c>
  a <http://id.loc.gov/vocabulary/preservation/eventType/fix>, cryphashfunc:sha256 ;
  rdf:value "6933a46f55f27a62689406ea33c650b1c16d6268ee81f6c6a2a89c63aeec9d27" ;
  dc:created "2019-12-22T16:16:37-0600" ;
  premis:outcome "success" .

<eb7951ac-3baf-4661-a181-76ef0995744b>
  a <http://id.loc.gov/vocabulary/preservation/eventType/fix>, cryphashfunc:sha256 ;
  rdf:value "6933a46f55f27a62689406ea33c650b1c16d6268ee81f6c6a2a89c63aeec9d27" ;
  dc:created "2019-12-23T11:28:13-0600" ;
  premis:outcome "success" .

<d3e39c84-ae5d-44bb-b8ce-fbe9289b1f31>
  a <http://id.loc.gov/vocabulary/preservation/eventType/fix>, cryphashfunc:sha256 ;
  rdf:value "6933a46f55f27a62689406ea33c650b1c16d6268ee81f6c6a2a89c63aeec9d27" ;
  dc:created "2019-12-23T16:19:05-0600" ;
  premis:outcome "success" .
```

Note that the fixity events are added by the [Islandora Riprap](https://github.com/mjordan/islandora_riprap) module, which implements Islandora PREMIS's `hook_islandora_premis_turtle_alter()` hook to add data to the PREMIS Turtle.

## Requirements

* [Islandora 8](https://github.com/Islandora/islandora)

If [Islandora Riprap](https://github.com/mjordan/islandora_riprap) is installed, fixity check events will be added to the PREMIS output.

## Installation

1. Clone this repo into your Islandora's `drupal/web/modules/contrib` directory.
1. Enable the module either under the "Admin > Extend" menu or by running `drush en -y islandora_premis`.

## Configuration

not done yet.

## Current maintainer

* [Mark Jordan](https://github.com/mjordan)

## License

[GPLv2](http://www.gnu.org/licenses/gpl-2.0.txt)
