<?php 

	class GroupesController extends AppController 
	{

        public function index()
        {
            $this->set('groupes', $this->Groupe->find('all'));
        }


        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $groupe = $this->Groupe->findById($id);
            if (!$groupe) {
                throw new NotFoundException(__('Invalid groupe'));
            }
            $this->set('groupe', $groupe);
        }


		public function creer() 
		{
            if($this->request->is('post'))
            {
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


        public function rejoindregroupe($id=null)
        {

            if (!$id) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $groupe = $this->Groupe->findById($id);
            if (!$groupe) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $val = AuthComponent::user('Membre');
            $membre = $this->Groupe->Membre->findByUsername($val['username']);

            $this->set('groupe', $groupe);
            $this->set('membre', $membre);

            /*memoriser l'id de l'utilisateur et l'id du groupe*/
            $d['membre_id']=$membre['Membre']['id'];
            $d['groupe_id']=$groupe['Groupe']['id'];

            $this->loadModel('MembresGroupes');
            $this->MembresGroupes->create();

            $mg = $this->MembresGroupes->query("
                SELECT *
                FROM membres_groupes
                WHERE membre_id = {$d['membre_id']} AND groupe_id = {$d['groupe_id']};"
            );
            if(empty($mg))
            {
                if($this->MembresGroupes->save($d, true, array('membre_id','groupe_id')))
                {
                    $this->Session->setFlash("Vous avez rejoint le groupe", "notif");
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
            else
            {
                $this->Session->setFlash("Vous êtes déjà membre", "notif");
            }
        }


        public function mesgroupes()
        {
            $val = AuthComponent::user('Membre');
            $membre = $this->Groupe->Membre->findByUsername($val['username']);

            $mg = $this->Groupe->query("
                SELECT G.id, G.nom, G.description
                FROM membres_groupes MG, Groupes G
                WHERE MG.groupe_id = G.id and membre_id = {$membre['Membre']['id']};"
            );

            if(empty($mg))
            {
                $this->Session->setFlash("Vous n'êtes membre d'aucun groupe", "notif");

            }
            else
            {
                $this->set('groupes', $mg);

            }
        }


        public function affichagegroupe($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $groupe = $this->Groupe->findById($id);
            if (!$groupe) {
                throw new NotFoundException(__('Invalid groupe'));
            }
            $this->set('groupe', $groupe);
        }

	}

?>
