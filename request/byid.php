<?php
include("fuseki.php");

$var = $_GET['id'];

$request = new fuseki("http://localhost:3030","kesehatan");
$qry = "
PREFIX sehat:<http://www.owl-ontologies.com/Kesehatan.owl#>
PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#>
PREFIX owl:<http://www.w3.org/2002/07/owl#>
SELECT *
WHERE {
	?y a sehat:AlatBantuKesehatan .
    ?y sehat:id '". $var ."' .
    ?y sehat:judul ?judul .
	?y sehat:harga ?harga . 
	?y sehat:foto ?foto .
	?y sehat:deskripsi ?deskripsi
}";

$request->setSparQl($qry);
$result = $request->sendRequest();

echo '<table class="table overflow table-striped table-hover table-bordered table-list">
                                <thead>
                                    <tr>
                                        <th>subject</th>
                                    </tr>
                                </thead>
                                <tbody>';


print($result[0]["judul"]["value"]);

echo "</tbody></table>";

?>
