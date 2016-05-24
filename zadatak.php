<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php
require_once '01_konekcija.php';
 
$popis=range("A","Z");
 
echo '<center>';
 
foreach ($popis as $key => $value) {
    echo '<p style="display:inline;">
              <a href="zadatak.php?id='.$value.'">'."|".$value."|</a>"
           . "</p>";
}
 
echo '</center><br/>';
 
#default odabir slova A.
if (!isset($_GET['id'])) 
{  
    $_GET['id']='A';
}
 
$slovo=$_GET['id'];
 
echo '<center>'
    .'<p>Svi gradovi koji počinju na slovo: '.$slovo.':</p>'
   . '</center><br/>';


$query="SELECT nazMjesto, nazZupanija, SUM(CASE WHEN s.pbrRod=m.pbr THEN 1 ELSE 0 END) AS rodjeni, 
            SUM(CASE WHEN s.pbrStan=m.pbr THEN 1 ELSE 0 END) AS zive,           
            MAX(FLOOR(DATEDIFF(NOW(), s.datRodStud)/365.25)) AS najstariji,             
            MIN(FLOOR(DATEDIFF(NOW(), s.datRodStud)/365.25)) AS najmladji
            FROM mjesto m        
            LEFT OUTER JOIN zupanija z ON z.sifZupanija = m.sifZupanija 
            LEFT OUTER JOIN stud s ON (s.pbrRod = m.pbr OR s.pbrStan = m.pbr)               
         WHERE nazMjesto LIKE '".$slovo."%' GROUP BY nazMjesto ORDER BY nazMjesto ASC;";
 

$result = mysql_query($query, $db);
while($row=  mysql_fetch_object($result))
{
    echo '<center>'.$row->nazMjesto.' : '.$row->nazZupanija.'<br/>';
    echo 'Broj rođenih studenata: '.$row->rodjeni.'<br/>';
    echo 'Broj žitelji: '.$row->zive.'<br/>';
    if (!$row->zive)
    {
        echo 'Nitko ne živi u ovom mjestu<br/><br/>';
    }
    else{
        echo 'Godine najstariji: '.$row->najstariji.'<br/>';
        echo 'Godine najmlađi: '.$row->najmladji.'<br/><br/></center>';
    } 
}

?>


 
    </body>
    
</html>