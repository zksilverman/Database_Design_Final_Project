<?php
include 'top.php';
?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Insert New Pet</h2>

    <?php 

    //defining variables
    $dataIsGood = true; 
    $pmkNumber = "";
    $fldPresidentId = "";
    $fldMainImage = "";
    $fldImageDescription = "";
    $fldAnimalName = "";
    $fldAnimalType = "";
    $fldSpeciesType = "";

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
            $sqlQuery = 'INSERT INTO tblPresdientPets SET ';
            $sqlQuery .= 'pmkNumber = ?, fldPresidentId = ?, fldMainImage = ?, fldImageDescription = ?, fldAnimalName = ?' ;
            $values = array($pmkNumber, $fldPresidentId, $fldMainImage, $fldImageDescription, $fldAnimalName);
            $result = $thisDatabaseWriter->insert($sqlQuery, $values);
            if(!empty($result)) {
                print '<p>Unsuccessfully added to the tblPresdientPets</p>';
            } else {
                print '<p>Successfully added to the tblPresdientPets</p>';
            }
            $sqlQuery2 = 'INSERT INTO tblPets SET ';
            $sqlQuery2 .= 'pmkNumber = ?, fldAnimalType = ?, fldSpeciesType = ?' ;
            $values2 = array($pmkNumber, $fldAnimalType, $fldSpeciesType);
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
                <input type="text" name="txtPmkNumber" id="txtPmkNumber">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtFldPresidentId">President ID Number:</label>
                <input type="text" name="txtFldPresidentId" id="txtFldPresidentId">
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Optional Pet Photo (you will have to upload photo manually)</p>
            <p>
                <textarea id="txtFldMainImage" name="txtFldMainImage" rows="2" cols="20"></textarea>
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Optional Image Description</p>
            <p>
                <textarea id="txtFldImageDescription" name="txtFldImageDescription" rows="2" cols="20"></textarea>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtFldAnimalName">Animal Name:</label>
                <input type="text" name="txtFldAnimalName" id="txtFldAnimalName">
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Animal Type</p>
            <p>
                <textarea id="txtFldAnimalType" name="txtFldAnimalType" rows="2" cols="20"></textarea>
            </p>
        </fieldset>
        <fieldset class="textarea">
            <p>Optional Species Type</p>
            <p>
                <textarea id="txtFldSpeciesType" name="txtFldSpeciesType" rows="2" cols="20"></textarea>
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