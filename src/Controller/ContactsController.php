<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
		$this->Auth->allow(['contactUs']);
		$this->loadComponent('Search.Prg', [
			'actions' => ['index']
		]);
    }
	
/**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function contactUs()
    {
		$page = TableRegistry::get('Pages');
		$query = $page->find('all', [
			'conditions' => ['slug' => 'contact']
		]);
		
		$page = $query->first();
		$this->viewBuilder()->layout('default');
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
			$contact->status = 0;
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
				$message = 'Hi Admin, <br />';
				$message .= 'Email: '.$contact->email.' <br />';
				$message .= 'Phone No: '.$contact->phone_no.' <br />';
				$message .= 'Message: '.$contact->message.' <br />
				Thanks';
				$email = new Email();
				$email->from(['info@gohijau.com' => 'Gohijau'])
					->to('vijayakumar.r@openwavecomp.in')
					->subject('Enquiry - '.date('m-d-Y'))
					->emailFormat('both')
					->send($message);	
					
                $this->Flash->success(__('The enquiry has been sent. we will reply shortly.'));
                return $this->redirect(['action' => 'contact_us']);
            } else {
                $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
            }
        }
		
		$this->set('page', $page);	
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('contacts', $this->paginate($this->Contacts));
        $this->set('_serialize', ['contacts']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
        $this->set('contact', $contact);
        $this->set('_serialize', ['contact']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
