<h1>Recherche avancée</h1>

<!--debut du formulaire-->
<form class="ajax" action="#" method="get">
	<p>
		<div class="row">
    		<div class="large-12 columns">
      			<div class="row collapse">
        			<div class="small-10 columns">
          				<input type="text" name="q" id="q" placeholder="Rechercher">
        			</div>
        				<div class="small-2 columns">
          					<input type="submit" class="button postfix" value="Go"></a>
        				</div>
      			</div>
    		</div>
  		</div>
  	</p>
</form>
<!--fin du formulaire-->
 
<!--preparation de l'affichage des resultats-->
<div id="results"></div>
<!--script>
$(document).ready( function() {
  // détection de la saisie dans le champ de recherche
  $('#q').keyup( function(){
    $field = $(this);
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
 
    // on commence à traiter à partir du 2ème caractère saisie
    if( $field.val().length > 1 )
    {
      // on envoie la valeur recherché en GET au fichier de traitement
      $.ajax({
  	type : 'GET', // envoi des données en GET ou POST
	url : '#' , // url du fichier de traitement
	data : 'q='+$(this).val() , // données à envoyer en  GET ou POST
	beforeSend : function() { // traitements JS à faire AVANT l'envoi
		$field.after('<img src="spinner.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
	},
	success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
		$('#ajax-loader').remove(); // on enleve le loader
		$('#results').html(data); // affichage des résultats dans le bloc
	}
      });
    }		
  });
});
</script-->

<?php

	if ($_GET['q']) {

	//connexion à la base de données 
	define('DB_NAME', 'filmoteque');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_HOST', 'localhost');
	 
	$link   =   mysql_connect( DB_HOST , DB_USER , DB_PASSWORD );
	mysql_select_db( DB_NAME , $link );
	 
	//recherche des résultats dans la base de données
	$result =   mysql_query( 'SELECT nom, id
	                          FROM films
	                          WHERE nom LIKE \'' . safe( $_GET['q'] ) . '%\'LIMIT 0,20' );
	$result2 = mysql_query( 'SELECT nom, id
	                          FROM acteurs
	                          WHERE nom LIKE \'' . safe( $_GET['q'] ) . '%\'LIMIT 0,20' );
	 
	// affichage d'un message "pas de résultats"
	if( (mysql_num_rows( $result ) == 0) && (mysql_num_rows( $result2 ) == 0))
	{
	?>
	    <h3 style="text-align:center; margin:10px 0;">Pas de r&eacute;sultats pour cette recherche</h3>
	<?php
	}
	else
	{	if(mysql_num_rows( $result ) != 0)
		{?>
			<h4>Résultat de film(s):</h4>
		<?php
	    // parcours et affichage des résultats
		    while( $post = mysql_fetch_object( $result ))
		    {
		    ?>
		        <div class="article-result">
		            <h4>
		            	<?php 
		            		echo $this->Html->link( 
		            			utf8_encode( $post->nom ),
		            			"/films/view/$post->id"); 
		            	?>
		            </h4>
		        </div>
		    <?php
		    }
		}
		if(mysql_num_rows( $result2 ) != 0)
		{?>
			<h4>Résultat d'acteur(s):</h4>
		<?php
	    	while( $post = mysql_fetch_object( $result2 ))
		    {
		    ?>
		        <div class="article-result">
		            <h3>
		            	<?php 
		            		echo $this->Html->link( 
		            			utf8_encode( $post->nom ),
		            			"/acteurs/view/$post->id"); 
		            	?>
		            </h3>
		        </div>
		    <?php
		    }
		}
	}
}
 
/*****
fonctions
*****/
function safe($var)
{
	$var = mysql_real_escape_string($var);
	$var = addcslashes($var, '%_');
	$var = trim($var);
	$var = htmlspecialchars($var);
	return $var;
}
?>
