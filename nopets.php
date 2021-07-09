<?php
include 'top.php';
?>

<main>
    <h2>Presidents with no Pets!</h2>
    <p>Only three American presidents have served their terms without ever owning or being gifted any pets.</p>
    <p>Interstingly enough, all three of these presidents were one-term conservative presidents. While this is of course not necessarily causation, it is a very interesting correlation! While Polk and Johnson were Democrats, they were president prior to when the parties switched, meaning that in the 1800s the Democratic Party was more conservative than the Republican Party. Another interesting correlation is that two out of these three presidents have been impeached (Johnson and Trump).</p>
    <hr>
    <?php 

        $sql = 'SELECT pmkNumber, fldName, fldParty, fldImage ';
        $sql.= 'FROM tblPresidenits ';
        $sql .= 'ORDER BY pmkNumber';

        $data = '';
        $presidents = $thisDatabaseReader->select($sql, $data);

        $sql2 = 'SELECT pmkNumber, fldName, fldParty, fldYearsInOffice ';
        $sql2.= 'FROM tblNoPets ';
        $sql2 .= 'ORDER BY pmkNumber';

        $data = '';
        $presidentsNoPets = $thisDatabaseReader->select($sql2, $data);

        if(is_array($presidents)){
            foreach($presidentsNoPets as $presidentNoPets){
                if(is_array($presidentsNoPets)){
                    foreach($presidents as $president){
                        if($presidentNoPets['fldName'] == $president['fldName']){
                            print '<figure class="president">';
                            print '<img alt="' . $president['fldName'] . '" src="images/' . $president["fldImage"] . '">';
                            print '</figure>';
                            print '</a>';
                            print '<p><b>President ' . $presidentNoPets['fldName']. '</b></p>';
                            print '<p>Years in Office: ' . $presidentNoPets['fldYearsInOffice'] . '</p>' ;
                            print '<p>Political Party: ' . $presidentNoPets['fldParty'] . '</p><hr>';
                        }
                    }
                }
            }
        } 

    ?>
</main>

<?php
include 'footer.php';
?>