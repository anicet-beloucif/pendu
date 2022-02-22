<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Esppace Administrateur</title>
	
</head>
	
<body>
	<header>
			<a href="index.php">Retourner au jeu</a>
	</header>
<main>
	<div id="mainwrapper">
<?php 


$testarr = explode(' ',file_get_contents('mots.txt')); 
echo '<table>';
foreach ($testarr as $k => $words) {
	echo '<tr><td>'.$words.'<br/></td>';
    echo '<td><form method ="post" action="">   
            <input type="submit" value="supprimer" name="'.$words.'" /> 
        </form></div></td></tr>';
    if( $k == 0){
    	$first= $words;
    } else {
    	if(isset($_POST[$words])){
			 $deleted = implode(' ',array_diff($testarr,array($words))); 
			 file_put_contents('mots.txt', $deleted);
			 header('Location:admin.php');
		}
    }
}
echo '</table>';


function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   ' ', 
        '/[’‘‹›‚]/u'    =>   ' ', 
        '/[“”«»„]/u'    =>   ' ', 
        '/ /'           =>   ' ', 
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}


?>
		<span>
			&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; 
		</span>
		<div id="addiv">
			<span> Entrez un nouveau mot ici </span>
		    <form method ="post">
		        <input type="text" name="letter" pattern="[A-Za-z]*" /> 
		    </form>  
		</div>
	</div> 
	<div id="subwrapper">
<?php 


if(isset($_POST['letter']) and !empty($_POST['letter'])){
	if(!strpos($_POST['letter'], ' ')){
		if(ctype_alpha($_POST['letter'])){ 	
			$text= implode(' ',$testarr);
			$addword=strtoupper(htmlspecialchars(cleanString($_POST['letter'])));

			if( !strpos(file_get_contents('mots.txt'), (' '.$addword)) and 
				!strpos(file_get_contents('mots.txt'), ($addword.' ')) and
				$first !== $addword ){
				
				$text .= ' '.$addword;
				file_put_contents('mots.txt', $text);
				header('Location:admin.php');
			} else {
				echo '<span>this word has already been taken</span>';
			}
		} else {
			echo '<span>invalid input</span>';
		}
	} else {
		echo '<span>invalid input</span>';
	}
}

?>	
	<div>
</main>
	<footer>
	</footer>
</body>
</html>