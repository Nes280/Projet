<?php
	class Distributeur extends AppModel
	{
		
		public $hasMany = array('Film');
		public $hasAndBelongsToMany = array(
			'Film'=>
				array(
					'className'=>'Film',
					'joinTable'=>'films_distributeurs'
					)
				);


	}
?>