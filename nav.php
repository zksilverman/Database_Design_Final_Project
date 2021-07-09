<nav>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "home") 
       {
           print 'activePage';
       }?>"
       href="home.php">Home
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "presidents") 
       {
           print 'activePage';
       }?>"
       href="presidents.php">Presidents
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "funfacts") 
       {
           print 'activePage';
       }?>" 
       href="funfacts.php">Fun Facts
    </a>
    <a class="<?php 
       if (PATH_PARTS['filename'] == "communications") 
       {
           print 'activePage';
       }?>" 
       href="communications.php">Recieve Communications
    </a>
</nav>  