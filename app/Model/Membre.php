<?php
	class Membre extends AppModel
	{
		public $validate = array(
			'nom' => array(
				array(
					'rule' => 'alphanumeric',
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Votre nom n'est pas valide"
				),
			),
			'prenom' => array(
				array(
					'rule' => 'alphanumeric',
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Votre prenom n'est pas valide"
				),
			),
			'username' => array(
				array(
					'rule' => 'alphanumeric',
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Votre pseudo n'est pas valide"
				),
				array(
					'rule' => 'isUnique',
					'message' => 'Ce pseudo est déjà pris'
				)
			),
			'mdp' => array(
					'rule' => 'NotEmpty',
					'message' => 'Vous devez entrer un mot de passe',
					'allowEmpty'=>false
			)
		);
	}
?>