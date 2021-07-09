<?php
include 'top.php';
$sql = 'SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, ';
$sql .= 'fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage ';
$sql.= 'FROM tblWildlife ';
$sql .= 'ORDER BY fldCommonName';

$data = '';
$animals = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <h2>Vermont's Wildlife</h2>
    <?php
    if(is_array($animals)){
        foreach($animals as $animal){
            print '<a href="displayCritter.php?cid=' . $animal['pmkWildlifeId'] . '">';
            print '<figure class="animal">';
            print '<img alt="' . $animal['fldCommonName'] . '" src="images/' . $animal['fldMainImage'] . '">';
            print '<figcaption>' . $animal['fldCommonName'] . '</figcaption>';
            print '</figure>';
            print '</a>';
        }
    } ?>

</main>

<?php
include 'footer.php';
?>