<?php
include 'top.php';
?>

<main>

    <section class="img">
        <figure>
            <img alt="Lucky, Reagan, and Thatcher" src="images/luckyreaganthatcher.jpg">
                <figcaption><i>Lucky, on the White House Lawn with Ronald Reagan and Margaret Thatcher</i> Photo by: <cite><a href="https://www.thoughtco.com/white-house-pets-4144590" target="_blank">Getty Images</a></cite></figcaption>
            </figure>
    </section>
    <?php

    //defining variables 
    $dataIsGood = true; 
    $firstName = "";
    $lastName = "";
    $email = "";
    $termsAndConditions = true;
    $recievingEmals = true;
    $recievingUpdates = true;
    $comments = "";
    $termAgreement = true;
    $wantsEmails = "";
    $wantsUpdates = "";
    $favorite = "";

    //function to check if a string is only alpha and spaces
    function verifyAlphaSpaces($testString) {
        $newTestString = str_replace(' ', '', $testString);
        return (ctype_alpha($newTestString));
    }

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

    if (!empty($_POST)){
        
        //sanitize
        $firstName = getData("txtFirstName");
        $lastName = getData("txtLastName");
        $email = getData("txtEmail");
        $comments = getData("txtQuestions");
        $favorite = getData("txtFavorite");
        $termsAndConditions = getData("chkTermsAndConditions");
        $recievingUpdates = getData("chkRecievingUpdates");
        $recievingEmals = getData("chkRecievingEmails");

        //validate
        //first name
        if (verifyAlphaSpaces($firstName) == false) {
            print '<p>Please enter a first name with only letters or whitespace</p>';
            $dataIsGood = false; 
        } elseif ($firstName == "") {
            print '<p>Please enter your first name.</p>';
            $dataIsGood = false;
        } else {
            $userFirstName = $firstName;
        }
        //last name
        if (verifyAlphaSpaces($lastName) == false) {
            print '<p>Please enter a last name with only letters or whitespace</p>';
            $dataIsGood = false; 
        } elseif ($lastName == "") {
            print '<p>Please enter your first name.</p>';
            $dataIsGood = false;
        } else {
            $userLastName = $lastName;
        }
        //email address
        if ($email == "") {
            print '<p>Please enter your email address.</p>';
            $dataIsGood = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            print '<p>Your email address appears to be incorrect.</p>';
            $dataIsGood = false;
        }
        else {
            $emailAddress = $email;
        }
        //terms and conditions
        if ($termsAndConditions == 1) { 
            $termAgreement = "1";
        } elseif ($termsAndConditions == 0) {
            $termAgreement = "0";
        }
        else {
            print '<p>Please select whether or not you agree to the terms and conditions</p>';
            $dataIsGood = false;
        }
        //recieving emails
        if ($recievingEmals == 1) { 
            $wantsEmails = "1";
        } elseif ($recievingEmals == 0) {
            $wantsEmails = "0";
        }
        else {
            print '<p>Please select whether or not you agree to the terms and conditions</p>';
            $dataIsGood = false;
        }
        //recieving updates
        if ($recievingUpdates == 1) { 
            $wantsUpdates = "1";
        } elseif ($recievingUpdates == 0) {
            $wantsUpdates = "0";
        }
        else {
            print '<p>Please select whether or not you want to be notified of any updates to the site</p>';
            $dataIsGood = false;
        }
        //comments
        if (verifyAlphaSpaces($comments) == false) {
            print '<p>Please enter comments using no special characters</p>';
            $dataIsGood = false; 
        } else {
            $userComments = $comments;
        }
        //favorite
        if (verifyAlphaSpaces($favorite) == false) {
            print '<p>Please enter comments using no special characters</p>';
            $dataIsGood = false; 
        } else {
            $userFavorite = $favorite;
        }



        //if the data is all correct, insert it in SQL
        if ($dataIsGood) {
            $sqlQuery = 'INSERT INTO tblCommunicationsResponses SET ';
            $sqlQuery .= 'pmkEmailAddress = ?, fldFirstName = ?, fldLastName = ?, fldTermsAndConditions = ?, fldUpdates = ?, fldPets = ?' ;
            $values = array($email, $userFirstName, $userLastName, $termAgreement, $recievingEmals, $wantsUpdates);
            $result = $thisDatabaseWriter->insert($sqlQuery, $values);
            if(!empty($result)) {
                print '<p>Unsuccessfully added to the tblCommunicationsResponses</p>';
            } else {
                print '<p>Successfully added to the tblCommunicationsResponses</p>';
            }
            $sqlQuery2 = 'INSERT INTO tblPetResponses SET ';
            $sqlQuery2 .= 'pmkEmailAddress = ?, fldQuestionsComments = ?, fldFavoritePet = ?' ;
            $values2 = array($email, $userComments, $userFavorite);
            $result2 = $thisDatabaseWriter->insert($sqlQuery2, $values2);
            if(!empty($result2)) {
                print '<p>Unsuccessfully added to the tblPetResponses</p>';
            } else {
                print '<p>Successfully added to the tblPetResponses</p>';
            }
            if(empty($result) && empty($result2)){
                //email variables
                $to = $email;
                $from = 'CS 148 Presidential Pets Team <zsilverm@uvm.edu>';
                $subject = 'Thank You from Presidential Pets Website';

                $mailMessage = '<p style="font: 14pt serif;">Thank you for filling out our short survey! We appreciate all your feedback and responses!</p>';
                $mailMessage .= '<p style="font: 14pt serif;">All your responses will help our website significantly and we will respond to any question you may have in a timely manner.</p>';
                $mailMessage .= '<p style="font: 14pt serif;">-Zoe Silverman from CS148</p>';

                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "From: " . $from . "\r\n";

                $mailSent = mail($to, $subject, $mailMessage, $headers);

                if ($mailSent){
                    print "<p>You have recieved an email confirmation!</p>";
                    print $mailMessage;
                }
            }else{
                print '<p>Email was not successfully delivered!</p>';
            }
        }

    }

    if (DEBUG == TRUE){
        print '<p>Post Array:</p><pre>';
        print_r($_POST);
        print $thisDatabaseReader->displayQuery($sqlQuery, $values);
        print $thisDatabaseReader->displayQuery($sqlQuery2, $values2);
        print '</pre>';
    }
    ?>
    <h2>Stay in touch!</h2>

    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="txtFirstName">First Name:</label>
                <input type="text" name="txtFirstName" id="txtFirstName" value = "<?php print $firstName; ?>">
            </p>
            <p>
                <label for="txtLastName">Last Name:</label>
                <input type="text" name="txtLastName" id="txtLastName" value = "<?php print $lastName; ?>">
            </p>
            <p>
                <label for="txtEmail">Email Address:</label>
                <input type="text" name="txtEmail" id="txtEmail" value = "<?php print $email; ?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <input <?php if($termsAndConditions){print " checked ";}?> type="checkbox" name="chkTermsAndConditions" id="chkTermsAndConditions"  value='1'>
                <label for="chkTermsAndConditions" class="formselection">I agree to the Terms and Conditions</label>
            </p>
            <p>
                <input <?php if($recievingUpdates){print " checked ";}?> type="checkbox" name="chkRecievingUpdates" id="chkRecievingUpdates"  value='1'>
                <label for="chkRecievingUpdates" class="formselection">I want to be notified of any updates</label>
            </p>
            <p>
                <input <?php if($recievingEmals){print " checked ";}?> type="checkbox" name="chkRecievingEmails" id="chkRecievingEmails"  value='1'>
                <label for="chkRecievingEmails" class="formselection">I personally own a pet</label>
            </p>
        </fieldset>
        <fieldset class="textarea">
                <p>
                    <label for="txtQuestions">Questions or Comments?</label>
                </p>
                <p>
                    <textarea id="txtQuestions" name="txtQuestions" rows="4" cols="35"><?php print $comments; ?></textarea>
                </p>
        </fieldset>
        <fieldset class="textarea">
                <p>
                    <label for="txtFavorite">Do you have a favorite Presidential Pet? If so, why?</label>
                </p>
                <p>
                    <textarea id="txtFavorite" name="txtFavorite" rows="4" cols="35"><?php print $favorite; ?></textarea>
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