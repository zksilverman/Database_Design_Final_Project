<?php
include 'top.php';


$sql = 'SELECT pmkNumber, fldName, fldParty, fldImage ';
$sql.= 'FROM tblPresidenits ';
$sql .= 'ORDER BY pmkNumber';

$data = '';
$presidents = $thisDatabaseReader->select($sql, $data);


$sql2 = 'SELECT fldPresidentName, fldAnimalName ';
$sql2.= 'FROM tblPresdientPets ';
$sql2 .= 'ORDER BY fldPresidentName';

$data2 = '';
$pets = $thisDatabaseReader->select($sql2, $data2);


//function to remove spaces
function removeSpaces($testString) {
    $newTestString = str_replace(' ', '', $testString);
    return ($newTestString);
}

?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Update Presidents</h2>


    <?php
    print '<ul>';
        if(is_array($presidents)){
            foreach($presidents as $president){
                print '<li>';
                print '<a href="../admin/updatepresidentform.php?pid=' .$president['pmkNumber'] . '">';
                print $president['fldName'];
                print '</a>';
                print '</li>';
            }
        } 

    print '</ul>';
    ?>



</main>

<?php
include 'footer.php';
?>

