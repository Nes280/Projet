<?php
	App::uses('AppModel', 'Model');
	class Format extends AppModel 
	{
		public $hasMany = array('Film');
		
	}

?>