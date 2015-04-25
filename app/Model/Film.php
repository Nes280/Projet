<?php
	class Film extends AppModel
	{
		public $validate = array(
			'nom' => array(
				array(
					'rule' => array('custom', '/^[a-z0-9\'éèà ]*$/i'),
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
					//'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
					'rule' => array('between', '5','3000'),
					'required' => true,
					'allowEmpty'=> false,
					'message'=>"Votre description n'est pas valide"
				)
			)
		);

		public $hasAndBelongsToMany = array(
			'Acteur'=>
				array(
					'className'=>'Acteur',
					'joinTable'=>'acteurs_films'
					),
			'Genre'=>
				array(
					'className'=>'Genre',
					'joinTable'=>'films_genres'
					), 
			'Realisateur'=>
				array(
					'className'=>'Realisateur',
					'joinTable'=>'films_realisateurs'
					),
			'Pays'=>
				array(
					'className'=>'Pays',
					'joinTable'=>'films_pays'
					),
			'Distributeur' => 
				array(
            		'className' => 'Distributeur',
            		'joinTable'=>'films_distributeurs'
        			)
				);
		public $hasMany = array(
        'Note' => array(
            'className' => 'Note'
        	)
    	);
	}
?>