<?php
	App::uses('AppModel', 'Model');
	class Acteur extends AppModel 
	{
		public $hasAndBelongsToMany = array(
			'Film'=>
				array(
					'className'=>'Film',
					'joinTable'=>'acteurs_films'
					)
				);


		
	}
?>