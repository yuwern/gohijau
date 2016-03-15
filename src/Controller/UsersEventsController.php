<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersEvents Controller
 *
 * @property \App\Model\Table\UsersEventsTable $UsersEvents
 */
class UsersEventsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Events']
        ];
        $this->set('usersEvents', $this->paginate($this->UsersEvents));
        $this->set('_serialize', ['usersEvents']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersEvent = $this->UsersEvents->get($id, [
            'contain' => ['Users', 'Events']
        ]);
        $this->set('usersEvent', $usersEvent);
        $this->set('_serialize', ['usersEvent']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersEvent = $this->UsersEvents->newEntity();
        if ($this->request->is('post')) {
            $usersEvent = $this->UsersEvents->patchEntity($usersEvent, $this->request->data);
            if ($this->UsersEvents->save($usersEvent)) {
                $this->Flash->success(__('The users event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users event could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersEvents->Users->find('list', ['limit' => 200]);
        $events = $this->UsersEvents->Events->find('list', ['limit' => 200]);
        $this->set(compact('usersEvent', 'users', 'events'));
        $this->set('_serialize', ['usersEvent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersEvent = $this->UsersEvents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersEvent = $this->UsersEvents->patchEntity($usersEvent, $this->request->data);
            if ($this->UsersEvents->save($usersEvent)) {
                $this->Flash->success(__('The users event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users event could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersEvents->Users->find('list', ['limit' => 200]);
        $events = $this->UsersEvents->Events->find('list', ['limit' => 200]);
        $this->set(compact('usersEvent', 'users', 'events'));
        $this->set('_serialize', ['usersEvent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersEvent = $this->UsersEvents->get($id);
        if ($this->UsersEvents->delete($usersEvent)) {
            $this->Flash->success(__('The users event has been deleted.'));
        } else {
            $this->Flash->error(__('The users event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
