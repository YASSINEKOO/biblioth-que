<?php

define("MYHOST","localhost"); 
define("MYUSER","root"); 
define("MYPASS","");
define("NomDb","mybibliothèque");

$idcom=@mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);