<?php 
	class DistributeursController extends AppController {
    public $helpers = array('Html', 'Form');


    public function index() {
     	
    }

    public function ajoutdistributeur($id=null)
    {
    	if (!$id) {
            throw new NotFoundException(__('Film non trouvé'));
        }
        $idfilm = $id;
        $film = $this->Distributeur->Film->findById($idfilm);
        $this->set('film', $film);
        $d = $this->request->data;

        if($this->request->is('post'))
        {
        	$d = $this->request->data;
            $d['Distributeur']['id'] = null;
            $valeur = 0;
            $resultat = $this->Distributeur->query("SELECT id FROM distributeurs WHERE nom='{$d['Distributeur']['nom']}';");

            if(empty($resultat))
            {
                if($this->Distributeur->save($d, true, array('nom')))
                {
                    $valeur = 1;
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
            else
            {
                $valeur =1;
            }

            if($valeur == 1)
            {
            	$res = $this->Distributeur->query("SELECT * FROM distributeurs WHERE nom='{$d['Distributeur']['nom']}';");
                $val['film_id']=$idfilm;
                $val['distributeur_id'] = $res['0']['distributeurs']['id'];
                $this->loadModel('FilmsDistributeurs');
                $this->FilmsDistributeurs->create();
                if($this->FilmsDistributeurs->save($val, true, array('film_id', 'distributeur_id')))
                {
                    
                    $this->redirect(array('controller' => 'Distributeurs', 'action' => 'ajoutdistributeur', $id));
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");

                }
            }
        }
    }
}
?>