<?php
	App::uses('AppModel', 'Model');
	class Realisateur extends AppModel 
	{
		public $hasAndBelongsToMany = array(
			'Film'=>
				array(
					'className'=>'Film',
					'joinTable'=>'films_realisateurs'
					)
				);
		
	}
?>