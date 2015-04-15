<?php
	App::uses('AppModel', 'Model');
	class Format extends AppModel 
	{
		public $hasAndBelongsToMany = array(
			'Film'=>
				array(
					'className'=>'Film',
					'joinTable'=>'films_formats'
					)
				);
		
	}

?>