<?php
include 'top.php';
?>

<main>
  <p>Select wildlife:<p>
  <pre>
    CREATE TABLE tblAdopter (
    pmkAdopterEmail varchar(50) NOT NULL,
    fldFirstName varchar(50) NOT NULL,
    fldLastName varchar(60) NOT NULL,
    fldAgreedToTerms tinyint(4) NOT NULL DEFAULT '1',
    fldRecieveCommunication tinyint(4) NOT NULL DEFAULT '1'
  )

  CREATE TABLE tblAdopterWildlife (
  pmkDonationId int(11) NOT NULL,
  fpkAdopterEmail varchar(50) NOT NULL,
  fpkWildlifeId int(11) NOT NULL,
  fldDonationAmount int(11) NOT NULL
)
  </pre>
</main>

<?php
include 'footer.php';
?>