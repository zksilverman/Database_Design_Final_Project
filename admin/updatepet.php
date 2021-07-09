<?php
include 'top.php';

$sql = 'SELECT pmkNumber, fldName, fldParty, fldImage ';
$sql.= 'FROM tblPresidenits ';
$sql .= 'ORDER BY pmkNumber DESC';

$data = '';
$presidents = $thisDatabaseReader->select($sql, $data);


$sql2 = 'SELECT fldPresidentId, fldAnimalName, pmkNumber ';
$sql2 .= 'FROM tblPresdientPets ';
$sql2 .= 'ORDER BY pmkNumber DESC';


$data2 = '';
$pets = $thisDatabaseReader->select($sql2, $data2);

?>

<main>
    <h2>Administrators only: Presidential Data</h2>
    <h2>Update Pets</h2>

    

    <?php
        if(is_array($presidents)){
            foreach($presidents as $president){
                //the button code was adapted from that of W3Schools, the link for their example is below!
                //https://www.w3schools.com/howto/howto_js_collapsible.asp
                print '<button type="button" class="collapsible">' . $president['fldName'] . "'s Pets</button>";
                print '<section class="content">';
                if(is_array($pets)){
                    foreach($pets as $pet){
                        if($pet['fldPresidentId'] == $president['pmkNumber']){
                            if($pet['fldAnimalName'] == ''){
                                print '<p>No pets!</p>';
                            } else {
                                print '<p>';
                                print '<a href="../admin/updatepetform.php?pid=' .$pet['pmkNumber'] . '">';
                                print $pet['fldAnimalName'];
                                print '</a>';
                                print '</p>';
                            }  
                        }
                    }
                }
                print '</section>';
            }
        }

    ?>

    <script>
    //this was cited from W3Schools, the link for the cite is below!
    //https://www.w3schools.com/howto/howto_js_collapsible.asp
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
        content.style.display = "none";
        } else {
        content.style.display = "block";
        }
    });
    }
    </script>
</main>

<?php
include 'footer.php';
?>

