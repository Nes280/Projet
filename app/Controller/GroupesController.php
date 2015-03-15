<?php 

	class GroupesController extends AppController 
	{

		public function creer() 
		{
            if($this->request->is('post'))
            {
                //debug($this->request->data);
                $d = $this->request->data;
                $d['Groupe']['id'] = null;
                if($this->Groupe->save($d, true, array('nom','description')))
                {
                    $this->Session->setFlash("Le groupe a bien été créé", "notif");
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
        }

	}

?>
