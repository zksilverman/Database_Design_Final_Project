<?php
include 'top.php';
?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Delete Pets</h2>
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
    
        if (!empty($_POST)){
            $sqlQuery = 'DELETE FROM tblPresdientPets WHERE ';
            $sqlQuery .= 'pmkNumber = ?' ;
            $values = array($petId);
            $result = $thisDatabaseWriter->delete($sqlQuery, $values);
            if(!empty($result)) {
                print '<p>Unsuccessfully deleted from tblPresdientPets</p>';
            } else {
                print '<p>Successfully deleted from tblPresdientPets</p>';
            }
            $sqlQuery2 = 'DELETE FROM tblPets WHERE ';
            $sqlQuery2 .= 'pmkNumber = ?';
            $values2 = array($petId);
            $result2 = $thisDatabaseWriter->delete($sqlQuery2, $values2);
            if(!empty($result2)) {
                print '<p>Unsuccessfully deleted from tblPets</p>';
            } else {
                print '<p>Successfully deleted from tblPets</p>';
            }
        }
    
    ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>Would you like to delete this pet?</p>
            <p>
                <input class="deletebutton" id="btnSubmit" name="btnSubmit" type="submit" value="Delete">
            </p>
        </fieldset>
    </form> 

    <?php
        if(is_array($pets)){
            foreach($pets as $pet){
                if($petId == $pet['pmkNumber']){
                    if($pet['fldAnimalName'] == ''){
                        print 'This president owned no pets! That must have been a sad White House!';
                        print ' To learn more about the three presidents to own no pets click <a href="https://zsilverm.w3.uvm.edu/cs148/final/nopets.php">here</a><hr>';
                    } else{
                        print '<section class="pets"><b>' . $pet["fldAnimalName"] . '</b>';
                        if(is_array($petInfo)){
                            foreach($petInfo as $petSpecies){
                                if($petSpecies['pmkNumber'] == $pet['pmkNumber']){
                                    print ' ' . $petSpecies["fldAnimalType"];
                                    if($petSpecies["fldSpeciesType"] != ''){
                                        print ' (' . $petSpecies["fldSpeciesType"] . ')';
                                    }
                                }
                            }
                        }
                        if($pet["fldMainImage"] != ''){
                            print '<figure class="petimage">';
                            print '<img alt="' . $pet["fldAnimalName"];
                            print '" src="images/'; 
                            print ($pet['fldMainImage']);
                            print '">';
                            print '<figcaption><p>' . $pet['fldImageDescription'] . '</p><p>Image from <a href="https://en.wikipedia.org/wiki/United_States_presidential_pets">Wikipedia</a></p></figcaption>';
                            print '</figure>';
                        }
                        print '</section>';
                    }
                    
                } 
            }
        }

    ?>
</main>

<?php
include 'footer.php';
?>