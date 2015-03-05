<?php
	App::uses('AppModel', 'Model');
	class Genre extends AppModel 
	{
		public $hasMany = array('Film');
		
	}

?>