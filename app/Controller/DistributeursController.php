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
            debug($d);
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
            	$res = $this->Distributeur->query("SELECT id FROM distributeurs WHERE nom='{$d['Distributeur']['nom']}';");
                if($this->Distributeur->Film->updateAll(
                        array(
                            'distributeur_id' => $res['0']['distributeur']['id']
                        ),
                        array('id' => $idfilm)
                ))
                {
                    $this->redirect(array('controller' => 'Acteurs', 'action' => 'ajoutacteurs', $id));
   
                }
                else
                {
                    
                }
            }
        }
    }
}
?>