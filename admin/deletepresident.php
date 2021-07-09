<?php
include 'top.php';


$sql = 'SELECT pmkNumber, fldName, fldParty, fldImage ';
$sql.= 'FROM tblPresidenits ';
$sql .= 'ORDER BY pmkNumber';

$data = '';
$presidents = $thisDatabaseReader->select($sql, $data);


//function to remove spaces
function removeSpaces($testString) {
    $newTestString = str_replace(' ', '', $testString);
    return ($newTestString);
}

?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Delete Presidents</h2>


    <?php
        print '<ul>';
        if(is_array($presidents)){
            foreach($presidents as $president){
                print '<li>';
                print '<a href="../admin/deleteformpresident.php?pid=' .$president['pmkNumber'] . '">';
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

