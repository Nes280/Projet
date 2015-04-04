<?php
	App::uses('AppModel', 'Model');
	class Genre extends AppModel 
	{
		public $hasAndBelongsToMany = array(
			'Film'=>
				array(
					'className'=>'Film',
					'joinTable'=>'films_genres'
					)
				);


		
	}

?>