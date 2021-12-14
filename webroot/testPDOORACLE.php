<?php
foreach(PDO::getAvailableDrivers() as $driver)
    {
    echo $driver.'<br />';
    }

try {
    $user = "TEREADM1";
    $pass = "moon";
    // On se connecte à MySQL
    // $mssql = new PDO("mysql:host=10.111.8.192;dbname=, twestely, mdp1234");
    // On se connecte à OCI_ORACLE
    //'mysql:host=localhost;dbname=test'
    $lien_base = "oci:dbname=(
    DESCRIPTION =
        (ADDRESS_LIST =	
            (ADDRESS =		
                (PROTOCOL = TCP)		
                (Host = "."gandalf".")		
                (Port = "."1523".")
            )
        )
        (CONNECT_DATA =
            (SID = ttere2)
        )
    )";
    $lienbase = "oci:dbname=TTERE210G";
     //$mssql = new PDO("oci:host=gandalf;dbname=ttere2", "tereadm1", "moon");
     $bdd = new PDO($lienbase, $user, $pass);
    // On se connecte à SQLite
    // $mssql = new PDO("sqlite:host=10.111.8.192;dbname=, twestely, mdp1234");
    // On se connecte à SYBASE
    // $mssql = new PDO("dblib:host=10.111.8.192;dbname=, twestely, mdp1234");
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
 
// On prépare et lance la requête avec les bons paramètres
$test = $bdd->query('SELECT * FROM ELECTION')or die(print_r($bdd->errorInfo()));

var_dump($test->execute()); //,$test->fetch());
var_export($test->fetchAll());
$test->closeCursor();

?>