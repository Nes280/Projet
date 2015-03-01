<?php 

    /*App::uses('AppController', 'Controller');
    App::uses('Rating','Lib');*/

	class MembresController extends AppController {
        public $helpers = array('Html', 'Form');

        //public $components = array('Session'); //servira pour la suite


        public function add() {
            if($this->request->is('post'))
            {
                debug($this->request->data);
                //$this->Membres->create();
                $nom= $this->request->data['Membres']['nom'];
                $prenom= $this->request->data['Membres']['prenom'];
                $pseudo= $this->request->data['Membres']['pseudo'];
                $login= $this->request->data['Membres']['login'];
                $age= $this->request->data['Membres']['age'];
                $admin =$this->request->data['Membres']['admin'];
                if(!empty($nom)&& !empty($prenom) && !empty($pseudo) && !empty($login) && !empty($age) && !empty($admin))
                {
                    /*$sql = "INSERT INTO membres VALUES (NULL,$nom, $prenom, $pseudo, $login, $age, $admin)";
                    $this->Membres->exec($sql);*/
                    //$this->Membres->save($this->request->data);
                }



            }
        }

    
}

?>