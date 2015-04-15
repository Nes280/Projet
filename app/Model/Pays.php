<?php
	App::uses('AppModel', 'Model');
	class Pays extends AppModel 
	{

		public $hasAndBelongsToMany = array(
			'Film'=>
				array(
					'className'=>'Film',
					'joinTable'=>'films_pays'
					)
				);


		
	}

?>