<?php
include 'top.php';
?>

<main>
    <?php

        $presidentId = (isset($_GET['pid'])) ? (string) htmlspecialchars($_GET['pid']) : 0;


        $sql = 'SELECT fldAnimalName FROM tblPresdientPets WHERE fldPresidentCode = ?';
        $data = array($presidentId);
        $pets = $thisDatabaseReader->select($sql, $data);

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

        $sql3 = 'SELECT pmkNumber, fldName ';
        $sql3.= 'FROM tblPresidenits WHERE pmkNumber = ?';
        $sql3 .= 'ORDER BY pmkNumber';
    
        $data3 = array($presidentId);
        $presidents = $thisDatabaseReader->select($sql3, $data3);
                 
        if(is_array($pets)){
            foreach($pets as $pet){
                if(is_array($presidents)){
                    foreach($presidents as $president){
                        if($presidentId == $president['pmkNumber']){
                            $presidentName = $president['fldName'];
                        }
                    }
                }
            }
        }
        
        print "<h2>Pet's Owned by President " . $presidentName . '</h2><hr>';

        if(is_array($pets)){
            foreach($pets as $pet){
                if($presidentId == $pet['fldPresidentId']){
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
                        print '</section><hr>';
                    }
                    
                } 
            }
        }

    ?>                    

</main>

<?php
include 'footer.php';
?>