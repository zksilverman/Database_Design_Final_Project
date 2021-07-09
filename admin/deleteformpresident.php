<?php
include 'top.php';

$presidentId = (isset($_GET['pid'])) ? (string) htmlspecialchars($_GET['pid']) : 0;

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
    
        if (!empty($_POST)){
            $sqlQuery = 'DELETE FROM tblPresidenits WHERE ';
            $sqlQuery .= 'pmkNumber = ?' ;
            $values = array($presidentId);
            $result = $thisDatabaseWriter->delete($sqlQuery, $values);
                if(!empty($result)) {
                    print '<p>Unsuccessfully added to the tblWildlife</p>';
                } 
        }
    
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>Would you like to delete this president?</p>
            <p>
                <input class="deletebutton" id="btnSubmit" name="btnSubmit" type="submit" value="Delete">
            </p>
        </fieldset>
    </form>

    <?php
        if(is_array($presidents)){
            foreach($presidents as $president){
                if($presidentId == $president['pmkNumber']){
                    print '<h2>' . $president['fldName'] . '</h2>';
                    print '<figure class="president">';
                    print '<img alt="' . $president['fldName'] . '" src="images/' . $president["fldImage"] . '">';
                    print '<figcaption>President ' . $president['fldName'] . '</figcaption>';
                    print '</figure>';
                    print '<p>Party: ' . $president['fldParty'] . '</p>';
                }
            }
        } 
    ?>



</main>

<?php
include 'footer.php';
?>

