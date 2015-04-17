<?php 
	class PaysController extends AppController {
    
    public function ajoutpays($id=null){
        if (!$id) {
            throw new NotFoundException(__('Film non trouvé'));
        }
        $idfilm = $id;
        $this->loadModel('Films');
        $this->Films->create();
        $film = $this->Films->findById($idfilm);
        $this->set('film', $film);
        $d = $this->request->data;

        $this->loadModel('Pays');
        $this->Pays->create();

        if($this->request->is('post'))
        {
            $d['Pays']['id'] = null;
            $valeur = 0;
            $resultat = $this->Pays->query("SELECT id FROM pays WHERE pays='{$d['Pays']['pays']}';");

            if(empty($resultat))
            {
                if($this->Pays->save($d, true, array('pays')))
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
                $res = $this->Pays->query("SELECT * FROM pays WHERE pays='{$d['Pays']['pays']}';");
                $val['film_id']=$idfilm;
                $val['pays_id'] = $res['0']['pays']['id'];
                $this->loadModel('FilmsPays');
                $this->FilmsPays->create();
                if($this->FilmsPays->save($val, true, array('film_id', 'pays_id')))
                {
                    $this->redirect(array('controller' => 'Pays', 'action' => 'ajoutpays', $id));
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