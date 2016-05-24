<?php



$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'fakultet';


$db = mysql_connect ($db_host, $db_user, $db_pass);
mysql_set_charset('utf8',$db);

if (!$db)
{
    echo 'Doslo je do problema kod spajanja na bazu.<br/>';
}
else {
    echo 'Uspjesno ste spojeni na bazu.<br/>';
    if (mysql_select_db($db_name))
    {
        echo 'Uspjesno odabrana baza.<br/>';   
    }   
    else {
        echo 'Problem kod odabira baze: ('.  mysql_errno().') '.mysql_error().
                '<br/>';
        
    }
}


