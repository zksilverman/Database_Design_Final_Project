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
    <h2>American Presidents</h2>
    <p>If you want to learn more about the pets owned by each President, click their name and see the many pets they owned!</p>

    <?php
        if(is_array($presidents)){
            foreach($presidents as $president){
                print '<a href="pet.php?pid=' . $president['pmkNumber'] . '">';
                print '<figure class="president">';
                print '<img alt="' . $president['fldName'] . '" src="images/' . $president["fldImage"] . '">';
                print '<figcaption>President ' . $president['fldName'] . '</figcaption>';
                print '</figure>';
                print '</a>';
            }
        } 
    ?>
    <p>You may be asking yourself: "Why does Grover Cleveland appear twice"? This is because President Cleveland is the only president to have served two non-consecutive terms in the White House! All other presidents either served once or served all their terms consecutively. The only president to serve more than two terms in office was FDR, who served a whopping four terms in office! This caused the 22nd Amendment to be created in 1951, which limited the number of terms a president can serve to two.</p>
    <p>All images are from <a href="https://en.wikipedia.org/wiki/List_of_presidents_of_the_United_States">Wikipedia</a></p>
</main>

<?php
include 'footer.php';
?>