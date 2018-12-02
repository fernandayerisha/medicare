<?php
include("fuseki.php");

$request = new fuseki("http://localhost:3030","kesehatan");
$qry = "
PREFIX sehat:<http://www.owl-ontologies.com/Kesehatan.owl#>

SELECT *
WHERE {
 	?y a sehat:AlatBantuKesehatan .
	?y sehat:id ?id .
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


// var_dump($result);
foreach ($result as $loop) {
    echo '<tr>';
    echo '<td>' . $loop['id']['value'] . '</td>';
    echo '<td>' . $loop['judul']['value'] . '</td>';
    echo '<td>' . $loop['harga']['value'] . '</td>';
    echo '<td>' . $loop['foto']['value'] . '</td>';
    echo '<td>' . $loop['deskripsi']['value'] . '</td>';
    echo '</tr>';
}

echo "</tbody></table>";

?>
