<?php

require "uwierzyt1.php";
 $title='donice';

$que = mysql_query("SELECT * FROM figury WHERE NrKat like 'don%' ");



 /* while($rek = mysql_fetch_array($que)){
	 
	 echo '<table border="1" rules="none" height="100" width="200">
	 <tr >
	<td align="center" > <h3>'.
        $rek['Nazwa']."<br />".
	'</h3></td>
	<td> Cena: '.
		$rek['Cena']." zł<br />".
	'</td>
	</tr>
	<tr >
	<td>
		<img src='.$rek['Fotka'].'>'.
	'</td>
	<td>'.
		$rek['Opis']."<br /><br /><br />".
		'waga: '.
		$rek['Waga']."kg<br />".
	'</td>
		</tr>
		</table>';
		
    }; */


	
	include 'szablonPrzedm.php';

?>