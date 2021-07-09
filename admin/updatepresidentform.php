<?php
include 'top.php';

$sql = 'SELECT pmkNumber, fldName, fldParty, fldImage ';
$sql.= 'FROM tblPresidenits ';
$sql .= 'ORDER BY pmkNumber';

$data = '';
$presidents = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Update President</h2>

    <?php

    $presidentId = (isset($_GET['pid'])) ? (int) htmlspecialchars($_GET['pid']) : 0;
    
    if(is_array($presidents)){
        foreach($presidents as $president){
            if($president['pmkNumber'] == $presidentId){
                //define all variables
                $pmkNumber = $president['pmkNumber'];
                $fldPresidentName = $president['fldName'];
                $fldParty = $president['fldParty'];
                $fldImage = $president['fldImage'];

            }
        }
    } 
    
    //defining variables
    $dataIsGood = true; 

    //getData function from the textbook
    function getData($field) {
        if (!isset($_POST[$field])) {
        $data = "";
        htmlspecialchars($data, ENT_QUOTES);
        }
        else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
        htmlspecialchars($data, ENT_QUOTES);
        }
        return $data;
    }

    //function to check if a string is only alpha and spaces
    function verifyAlphaSpaces($testString) {
        $newTestString = str_replace(' ', '', $testString);
        return (ctype_alpha($newTestString));
    }

    if (!empty($_POST)){
    
        //sanitize
        $pmkNumber = (int) getData('txtPmkNumber');
        $fldPresidentName = getData('txtPresidentName');
        $fldParty = getData('txtFldParty');
        $fldImage = getData('txtFldImage');

        //validate
        //pmkNumber
        if ($pmkNumber == "") {
            print '<p>Please choose a Number ID.</p>';
            $dataIsGood = false;
        } elseif (!is_int($pmkNumber)) {
            print '<p>Your president ID needs to be a number</p>';
            $dataIsGood = false;
        }
        //fldPresidentName
        if ($fldPresidentName == "") {
            print '<p>Please add a president name</p>';
            $dataIsGood = false;
        } elseif (verifyAlphaSpaces($fldPresidentName) == false){
            print '<p>Please enter a Name with only letters or whitespace</p>';
            $dataIsGood = false; 
        }
        //fldParty
        if ($fldParty == ""){
            print "<p>Please write the president's political party</p>";
            $dataIsGood = false;
        } elseif (verifyAlphaSpaces($fldParty) == false){
            print '<p>Please enter a Party with only letters or whitespace</p>';
            $dataIsGood = false; 
        }
        //fldImage
        if ($fldImage == ""){
            print "<p>Please the title of the image</p>";
            $dataIsGood = false;
        }



        //if the data is all correct, insert it in SQL
        if ($dataIsGood) {
            //first table
            $sqlQuery = 'UPDATE tblPresidenits SET ';
            $sqlQuery .= 'pmkNumber = ?, fldName = ?, fldParty = ?, fldImage = ?' ;
            $sqlQuery .= 'WHERE pmkNumber = ?';
            $values = array($pmkNumber, $fldPresidentName, $fldParty, $fldImage, $presidentId);
            $result = $thisDatabaseWriter->insert($sqlQuery, $values);
            if(!empty($result)) {
                print '<p>Unsuccessfully added to the tblPresidenits</p>';
            } else {
                print '<p>Successfully added to the tblPresidenits</p>';
            }
        }
    
    }
    ?>  


    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="txtPmkNumber">Primary Key Number:</label>
                <input type="text" name="txtPmkNumber" id="txtPmkNumber" value = "<?php print $pmkNumber; ?>">

            </p>
        </fieldset>
        <fieldset class="textarea">
                <p>President Name</p>
                <p>
                    <textarea id="txtPresidentName" name="txtPresidentName" rows="2" cols="20"><?php print $fldPresidentName; ?></textarea>
                </p>
        </fieldset>
        <fieldset class="textarea">
                <p>President's Political Party</p>
                <p>
                    <textarea id="txtFldParty" name="txtFldParty" rows="2" cols="20"><?php print $fldParty; ?></textarea>
                </p>
        </fieldset>
        <fieldset class="textarea">
                <p>President Photo (you will have to upload photo manually)</p>
                <p>
                    <textarea id="txtFldImage" name="txtFldImage" rows="2" cols="20"><?php print $fldImage; ?></textarea>
                </p>
        </fieldset>
        <fieldset class="buttons">
            <input id="btnSubmit" name="btnSubmit" type="submit" value="Submit">
        </fieldset>
    </form>

</main>

<?php
include 'footer.php';
?>