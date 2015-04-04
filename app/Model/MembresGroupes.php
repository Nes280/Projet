<?php
	class MembresGroupes extends AppModel
	{

		public $hasAndBelongsToMany = array(
			'Membre'=>
				array(
					'className'=>'Membre',
					),
			'Groupe'=>
				array(
					'className'=>'Groupe',
					),
			
				);

	}
?>