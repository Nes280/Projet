<?php
	class Film extends AppModel
	{
		public $validate = array(
			'nom' => array(
				array(
					'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Le nom n'est pas valide"
				),
				array(
					'rule' => 'isUnique',
					'message' => 'Ce nom est déjà pris'
				)
			), 
			'synopsis' => array(
				array(
					'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Votre description n'est pas valide"
				),
				array(
					'rule' => 'isUnique',
					'message' => 'Ce nom est déjà pris'
				)
			)
		);
	}
?>