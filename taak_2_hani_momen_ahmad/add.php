<?php
//var_dump($_POST);   // to see if I get values ​​of the form
include("database/config.php"); // 1-stap   include files
include("database/opendb.php");

if ((isset($_POST['id'])) && (isset($_POST['lenght']))      &&
(isset($_POST['lenghts']))     && (isset($_POST['Roest']))       &&
(isset($_POST['Vermonderde'])) && (isset($_POST['meetouten']))   &&
(isset($_POST['Totale']))      &&  (isset($_POST['type']))       &&
(isset($_POST['Positie']))     &&  (isset($_POST['Datum']))      &&
(isset($_POST['Kabelleverancier']))   &&  (isset($_POST['waannemingen']))  &&
(isset($_POST['Handtekening'])) &&  (isset($_POST['bdrijfsuren']))&&
(isset($_POST['Redenen']))){

    $lenght = $_POST['id'];
    $lenght = $_POST['lenght'];
    $lenghts = $_POST['lenghts'];
    $Roest = $_POST['Roest'];    
    $Vermonderde = $_POST['Vermonderde'];
    $meetouten = $_POST['meetouten'];
    $Totale = $_POST['Totale'];  
    $type = $_POST['type'];
    $Positie = $_POST['Positie'];
    $Datum = $_POST['Datum'];
    $Kabelleverancier = $_POST['Kabelleverancier'];
    $waannemingen = $_POST['waannemingen'];
    $Handtekening = $_POST['Handtekening'];
    $bdrijfsuren = $_POST['bdrijfsuren'];
    $Redenen = $_POST['Redenen'];
} else {
    echo "Verplichte velden ontbreken, verwerking gestopt.";
    include("database/closedb.php");
    exit;
}


if ($lenght === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($lenghts === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Roest === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Vermonderde === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($meetouten === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Totale === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($type === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Positie === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Datum === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Kabelleverancier === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($waannemingen === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($waannemingen === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($bdrijfsuren === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}
if ($Redenen === "") {
    echo "Er is geen voornaam ingegeven";
    include("database/closedb.php");
    exit;
}

// begin transaction
mysqli_autocommit($dbaselink,FALSE);

$query = "SELECT MAX(id) AS maxid ";
$query .= "FROM  hijskraangegevens ";
// Prepare and execute the query

$preparedquery = $dbaselink->prepare($query);
$preparedquery->execute();

// Check for errors
if ($preparedquery->errno) {
    echo "Fout bij uitvoeren commando, probeer het later nogmaals.";
}
// Get the result

$result = $preparedquery->get_result();
// Set maxId

$maxId=0;
// Fetch current maxid

while ($row = mysqli_fetch_array($result)) {
        $maxId = $row["maxid"];
}
// Close first SQL statement
$preparedquery->close();
// The next person shall have one (1) number higher
$currentId = $maxId + 1;
if ($currentId > 10) {
    mysqli_rollback($dbaselink);
    echo"A maximum of ten digits";
    exit;
} else {
    $query = "INSERT INTO  hijskraangegevens ";
    $query .= "(id,lenght,lenghts,Roest,Vermonderde,meetouten,Totale,type,
    Positie,Datum,Kabelleverancier,waannemingen,Handtekening,bdrijfsuren,Redenen) ";
    $query .= "VALUES(
        ?,?,?,
        ?,?,?,
        ?,?,?
        ,?,?,?
        ,?,?,?) ";
    // Prepare the statement
    $preparedquery = $dbaselink->prepare($query);

    // Bind the variables, types and position questionmarks
    $preparedquery->bind_param("iiiiiiisiisssis",$currentId,$lenght,$lenghts,$Roest,$Vermonderde,$meetouten,$Totale,$type,
    $Positie,$Datum,$Kabelleverancier,$waannemingen,$Handtekening,$bdrijfsuren,$Redenen);

    // Execute the command
    $preparedquery->execute();
    // Check for errors
    if ($preparedquery->errno){
        echo "Er is een fout opgetreden. Verwerking afgebroken.";
    } else {
        echo "Toegevoegd gebruiker met nummer ";
}
// Close second SQL statement
$preparedquery->close();

}
//end transaction
//mysqli_autocommit($dbaselink,FALSE);

// Close the database handler
include("database/closedb.php");

?>