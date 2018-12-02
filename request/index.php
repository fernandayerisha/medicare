<?php
include("fuseki.php");

//$request = new fuseki("http://10.34.9.69:3030","ds");
$request = new fuseki("http://localhost:3030","mycoba");
$qry = "
PREFIX family: <http://www.semanticweb.org/prasiman/family#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX owl: <http://www.w3.org/2002/07/owl#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

SELECT *
WHERE {
    ?s ?p ?o .
}";
$request->setSparQl($qry);
$result = $request->sendRequest();

echo '<table class="table overflow table-striped table-hover table-bordered table-list">
                                <thead>
                                    <tr>
                                        <th>subject</th>
                                        <th>predicate</th>
                                        <th>object</th>
                                    </tr>
                                </thead>
                                <tbody>';
foreach ($result as $loop) {
    echo "<tr>";
    echo "<td>" . $loop['s']['value'] . "</td>";
    echo "<td>" . $loop['p']['value'] . "</td>";
    echo "<td>" . $loop['o']['value'] . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
?>
