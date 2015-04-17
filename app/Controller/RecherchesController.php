<?php 
	class RecherchesController extends AppController {
    public $helpers = array('Html', 'Form');


    public function index() {
     	function safe($var)
		{
			$var = mysql_real_escape_string($var);
			$var = addcslashes($var, '%_');
			$var = trim($var);
			$var = htmlspecialchars($var);
			return $var;
		}
        //$this->set('films', $this->Film->find('all'));
        if ($_GET['q']) {

			//connexion à la base de données 
			define('DB_NAME', 'filmoteque');
			define('DB_USER', 'root');
			define('DB_PASSWORD', '');
			define('DB_HOST', 'localhost');
			 
			$link   =   mysql_connect( DB_HOST , DB_USER , DB_PASSWORD );
			mysql_select_db( DB_NAME , $link );
			 
			//recherche des résultats dans la base de données
			$resulta =   mysql_query( 'SELECT nom, id
			                          FROM films
			                          WHERE nom LIKE \'%' . safe( $_GET['q'] ) . '%\'' );
			$resulta2 = mysql_query( 'SELECT nom,prenom, id
			                          FROM acteurs
			                          WHERE nom LIKE \'%' . safe( $_GET['q'] ) . '%\'
			                          OR prenom LIKE \'%' . safe( $_GET['q'] ) . '%\'');
			$resulta3 = mysql_query( 'SELECT nom,prenom, id
			                          FROM realisateurs
			                          WHERE nom LIKE \'%' . safe( $_GET['q'] ) . '%\'
			                          OR prenom LIKE \'%' . safe( $_GET['q'] ) . '%\'');
			$this->set('result', $resulta);
			$this->set('result2', $resulta2);
			$this->set('result3', $resulta3);
		}
    }
}
?>