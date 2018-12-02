<?php
include("fuseki.php");

$request = new fuseki("http://localhost:3030","kesehatan");
$qry = "
PREFIX sehat:<http://www.owl-ontologies.com/Kesehatan.owl#>
PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#>

SELECT ?label
WHERE {
	?y rdfs:subClassOf sehat:Kesehatan .
	?y rdfs:label ?label
}";

$request->setSparQl($qry);
$result = $request->sendRequest();

    // var_dump($result);

$otong = [];

foreach ($result as $key) {
    $main = str_replace(' ', '', $key["label"]["value"]);

    $qry = "
        PREFIX sehat:<http://www.owl-ontologies.com/Kesehatan.owl#>
        PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#>
        PREFIX owl:<http://www.w3.org/2002/07/owl#>
        SELECT ?label
        WHERE {
            ?y rdfs:subClassOf sehat:". $main ." .
            ?y rdfs:label ?label
        }";

    
    $request->setSparQl($qry);
    $result1 = $request->sendRequest();

    $cok = array();
    $cok1 = array($main, [$cok]);
    
    foreach ($result1 as $key1) { 

    $main1 = $key1["label"]["value"];

    array_push($cok, $main1);
    }
    array_push($otong, $cok);
}
    print_r($otong);

?>
