<nav>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "insertpresident") 
       {
           print 'activePage';
       }?>"
       href="insertpresident.php">Insert President
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "insertpet") 
       {
           print 'activePage';
       }?>"
       href="insertpet.php">Insert Pet
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "updatepresident") 
       {
           print 'activePage';
       }?>"
       href="updatepresident.php"> Update President
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "updatepet") 
       {
           print 'activePage';
       }?>"
       href="updatepet.php"> Update Pet
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "deletepresident") 
       {
           print 'activePage';
       }?>"
       href="deletepresident.php">Delete President
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "deletepet") 
       {
           print 'activePage';
       }?>"
       href="deletepet.php">Delete Pet
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "adminreports") 
       {
           print 'activePage';
       }?>"
       href="adminreports.php">Admin Reports
    </a>
    <a href="../home.php">Return Home</a>

</nav>  