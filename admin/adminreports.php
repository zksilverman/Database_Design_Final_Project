<?php
include 'top.php';
?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Admin Report One: Information on Survey Respondants</h2>
    <?php
        $sql = 'SELECT pmkEmailAddress, fldTermsAndConditions, fldUpdates, fldPets ';
        $sql.= 'FROM tblCommunicationsResponses ';
        $sql .= 'ORDER BY pmkEmailAddress';
     
        $data = '';
        $surveyResponses = $thisDatabaseReader->select($sql, $data);

        $numberOfResponses = count($surveyResponses);

        //terms and conditions count
        $sqlCountTermsAndConditions = 'SELECT COUNT(fldTermsAndConditions) FROM tblCommunicationsResponses ';
        $sqlCountTermsAndConditions .= 'WHERE fldTermsAndConditions = ?';
        $data2 = array('1');
        $termsAndConditions = $thisDatabaseReader->select($sqlCountTermsAndConditions, $data2);
        //i learned about the function array_keys from a tutorial republic article
        //the article is linked below and listed in on my site map index page
        //https://www.tutorialrepublic.com/faq/foreach-loop-through-multidimensional-array-in-php.php
        $itemsTermsAndConditions = array_keys($termsAndConditions);
        print '<ul>';
        for($i = 0; $i < count($termsAndConditions); $i++) {
            foreach($termsAndConditions[$itemsTermsAndConditions[$i]] as $itemsTermsAndConditions => $termsAndConditionsTotal) {
                $termsAndConditionsPercentage = ($termsAndConditionsTotal / $numberOfResponses) * 100;
                print '<li>Percentage of respondants who agreed to the terms and conditions: ' . $termsAndConditionsPercentage . '%</li>';
            }
        }
        
        //updates count
        $sqlCountUpdates = 'SELECT COUNT(fldUpdates) FROM tblCommunicationsResponses ';
        $sqlCountUpdates .= 'WHERE fldUpdates = ?';
        $data3 = array('1');
        $updates = $thisDatabaseReader->select($sqlCountUpdates, $data3);
        //i learned about the function array_keys from a tutorial republic article
        //the article is linked below and listed in on my site map index page
        //https://www.tutorialrepublic.com/faq/foreach-loop-through-multidimensional-array-in-php.php
        $itemsUpdates = array_keys($updates);
        for($i = 0; $i < count($updates); $i++) {
            foreach($updates[$itemsUpdates[$i]] as $itemsUpdates => $updatesTotal) {
                $updatesPercentage = ($updatesTotal / $numberOfResponses) * 100;
                print '<li>Percentage of respondants who agreed to recieve email updates: ' . $updatesPercentage . '%</li>';  
          }
        }

        //pets count
        $sqlCountPets = 'SELECT COUNT(fldPets) FROM tblCommunicationsResponses ';
        $sqlCountPets .= 'WHERE fldPets = ?';
        $data4 = array('1');
        $pets = $thisDatabaseReader->select($sqlCountPets, $data4);
        //i learned about the function array_keys from a tutorial republic article
        //the article is linked below and listed in on my site map index page
        //https://www.tutorialrepublic.com/faq/foreach-loop-through-multidimensional-array-in-php.php
        $itemsPets = array_keys($pets);
        for($i = 0; $i < count($pets); $i++) {
            foreach($pets[$itemsPets[$i]] as $itemsPets => $petsTotal) {
                $petsPercentage = ($petsTotal / $numberOfResponses) * 100;
                print '<li>Percentage of respondants who own their own pet: ' . $petsPercentage . '%</li>';  
          }
        }
        print '</ul>';


    ?>
    <h2>Admin Report Two: Number of Each Type of Species</h2>
    <?php 
        //create a multidimensional array to hold each species type, and the number of pets that have that species
        $sqlAnimalType = 'SELECT fldAnimalType ';
        $sqlAnimalType.= 'FROM tblPets ';
        $sqlAnimalType .= 'ORDER BY fldAnimalType';
     
        $data5 = '';
        $speciesReport = $thisDatabaseReader->select($sqlAnimalType, $data5);

        //create empty array
        $speciesArray = array();

        //iterate through the entire $speciesReport
        for($i = 0; $i < count($speciesReport); $i++) {
            $species = $speciesReport[$i]['fldAnimalType']; 
            //print $species;
            if(array_key_exists($species, $speciesArray)){
                //if species is already listed, then add one
                $speciesArray[$species] += 1;
            }else{ //if species is not already listed
                $speciesArray[$species] = 1;
            }
        }

        //print the species counts
        print '<ul>';
        foreach ($speciesArray as $animal=>$number){
            if($animal!=='NONE'){
                print '<li>' . $animal . ': ' . $number ."</li>";
            }
        }
        print '</ul>';
    ?>
</main>


<?php
include 'footer.php';
?>