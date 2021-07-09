<?php
include 'top.php';
?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Update Pets</h2>
    <?php

        $petId = (isset($_GET['pid'])) ? (string) htmlspecialchars($_GET['pid']) : 0;

        $sql = 'SELECT pmkNumber, fldPresidentId, fldMainImage, ';
        $sql .= 'fldImageDescription, fldAnimalName ';
        $sql.= 'FROM tblPresdientPets ';
        $sql .= 'ORDER BY pmkNumber';
    
        $data = '';
        $pets = $thisDatabaseReader->select($sql, $data);

        $sql2 = 'SELECT pmkNumber, fldAnimalType, fldSpeciesType ';
        $sql2.= 'FROM tblPets ';
        $sql2 .= 'ORDER BY pmkNumber';
    
        $data2 = '';
        $petInfo = $thisDatabaseReader->select($sql2, $data2);

        //defining variables
        if(is_array($pets)){
            foreach($pets as $pet){
                if($pet['pmkNumber'] == $petId){
                    //define all variables
                    $pmkNumber = $pet['pmkNumber'];
                    $fldPresidentId = $pet['fldPresidentId'];
                    $fldMainImage = $pet['fldMainImage'];
                    $fldImageDescription = $pet['fldImageDescription'];
                    $fldAnimalName = $pet['fldAnimalName'];
                }
            }
        } 
        if(is_array($petInfo)){
            foreach($petInfo as $petStat){
                if($petStat['pmkNumber'] == $petId){
                    //define all variables
                    $fldAnimalType = $petStat['fldAnimalType'];
                    $fldSpeciesType = $petStat['fldSpeciesType'];
                }
            }
        } 

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
            $fldPresidentId = (int) getData('txtFldPresidentId');
            $fldMainImage = getData('txtFldMainImage');
            $fldImageDescription = getData('txtFldImageDescription');
            $fldAnimalName = getData('txtFldAnimalName');
            $fldAnimalType = getData('txtFldAnimalType');
            $fldSpeciesType = getData('txtFldSpeciesType');

            //validate
            //pmkNumber
            if ($pmkNumber == "") {
                print '<p>Please choose a Number ID.</p>';
                $dataIsGood = false;
            } elseif (!is_int($pmkNumber)) {
                print '<p>Your pet ID needs to be a number</p>';
                $dataIsGood = false;
            }
            //fldPresidentId
            if ($fldPresidentId == "") {
                print '<p>Please choose a President ID.</p>';
                $dataIsGood = false;
            } elseif (!is_int($fldPresidentId)) {
                print '<p>Your President ID needs to be a number</p>';
                $dataIsGood = false;
            }
            //fldAnimalName
            if ($fldAnimalName == "") {
                print '<p>Please choose a Animal Name.</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaSpaces($fldAnimalName)) {
                print '<p>Your Animal Name can only include letters and spaces.</p>';
                $dataIsGood = false;
            }
            //fldAnimalType
            if ($fldAnimalType == "") {
                print '<p>Please write the Animal Type.</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaSpaces($fldAnimalType)) {
                print '<p>Your Animal Type can only include letters and spaces.</p>';
                $dataIsGood = false;
            } 

            //if the data is all correct, insert it in SQL
            if ($dataIsGood) {
                $sqlQuery = 'UPDATE tblPresdientPets SET ';
                $sqlQuery .= 'fldPresidentId = ?, fldMainImage = ?, fldImageDescription = ?, fldAnimalName = ? ' ;
                $sqlQuery .= 'WHERE pmkNumber = ?';
                $values = array($fldPresidentId, $fldMainImage, $fldImageDescription, $fldAnimalName, $pmkNumber);
                $result = $thisDatabaseWriter->insert($sqlQuery, $values);
                if(!empty($result)) {
                    print '<p>Unsuccessfully added to the tblPresdientPets</p>';
                } else {
                    print '<p>Successfully added to the tblPresdientPets</p>';
                }
                $sqlQuery2 = 'UPDATE tblPets SET ';
                $sqlQuery2 .= 'fldAnimalType = ?, fldSpeciesType = ? ' ;
                $sqlQuery2 .= 'WHERE pmkNumber = ?';
                $values2 = array($fldAnimalType, $fldSpeciesType, $pmkNumber);
                $result2 = $thisDatabaseWriter->insert($sqlQuery2, $values2);
                if(!empty($result2)) {
                    print '<p>Unsuccessfully added to the tblPets</p>';
                } else {
                    print '<p>Successfully added to the tblPets</p>';
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
        <fieldset>
            <p>
                <label for="txtFldPresidentId">President ID Number:</label>
                <input type="text" name="txtFldPresidentId" id="txtFldPresidentId" value = "<?php print $fldPresidentId; ?>">
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Optional Pet Photo (you will have to upload photo manually)</p>
            <p>
                <textarea id="txtFldMainImage" name="txtFldMainImage" rows="2" cols="20"><?php print $fldMainImage; ?></textarea>
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Optional Image Description</p>
            <p>
                <textarea id="txtFldImageDescription" name="txtFldImageDescription" rows="2" cols="20"><?php print $fldImageDescription; ?></textarea>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtFldAnimalName">Animal Name:</label>
                <input type="text" name="txtFldAnimalName" id="txtFldAnimalName" value = "<?php print $fldAnimalName; ?>">
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Animal Type</p>
            <p>
                <textarea id="txtFldAnimalType" name="txtFldAnimalType" rows="2" cols="20"><?php print $fldAnimalType; ?></textarea>
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Optional Species Type</p>
            <p>
                <textarea id="txtFldSpeciesType" name="txtFldSpeciesType" rows="2" cols="20"><?php print $fldSpeciesType; ?></textarea>
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