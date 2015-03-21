<?php
	class Groupe extends AppModel
	{
		public $validate = array(
			'nom' => array(
				array(
					'rule' => 'alphanumeric',
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Le nom n'est pas valide"
				),
				array(
					'rule' => 'isUnique',
					'message' => 'Ce nom est déjà pris'
				)
			),
			'description' => array(
				array(
					'rule' => 'alphanumeric',
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Votre description n'est pas valide"
				),
			)
		);

		public $hasAndBelongsToMany = array(
			'Membre'=>
				array(
					'className'=>'Membre',
					'joinTable'=>'membres_groupes'
					)
				);


	}
?>