<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NewsSnippets Controller
 *
 * @property \App\Model\Table\NewsSnippetsTable $NewsSnippets
 */
class NewsSnippetsController extends AppController
{

    /**
     * User method
     *
     * @return void
     */
    public function user()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('newsSnippets', $this->paginate($this->NewsSnippets));
        $this->set('_serialize', ['newsSnippets']);
    }
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('newsSnippets', $this->paginate($this->NewsSnippets));
        $this->set('_serialize', ['newsSnippets']);
    }

    /**
     * View method
     *
     * @param string|null $id News Snippet id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $newsSnippet = $this->NewsSnippets->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('newsSnippet', $newsSnippet);
        $this->set('_serialize', ['newsSnippet']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $newsSnippet = $this->NewsSnippets->newEntity();
		$this->request->data['user_id'] = $this->Auth->user('id');
		$this->request->data['status'] = 1;		
        if ($this->request->is('post')) {
            $newsSnippet = $this->NewsSnippets->patchEntity($newsSnippet, $this->request->data);
            if ($this->NewsSnippets->save($newsSnippet)) {
                $this->Flash->success(__('The news snippet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news snippet could not be saved. Please, try again.'));
            }
        }
        $users = $this->NewsSnippets->Users->find('list', ['limit' => 200]);
        $this->set(compact('newsSnippet', 'users'));
        $this->set('_serialize', ['newsSnippet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id News Snippet id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $newsSnippet = $this->NewsSnippets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newsSnippet = $this->NewsSnippets->patchEntity($newsSnippet, $this->request->data);
            if ($this->NewsSnippets->save($newsSnippet)) {
                $this->Flash->success(__('The news snippet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news snippet could not be saved. Please, try again.'));
            }
        }
        $users = $this->NewsSnippets->Users->find('list', ['limit' => 200]);
        $this->set(compact('newsSnippet', 'users'));
        $this->set('_serialize', ['newsSnippet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id News Snippet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $newsSnippet = $this->NewsSnippets->get($id);
        if ($this->NewsSnippets->delete($newsSnippet)) {
            $this->Flash->success(__('The news snippet has been deleted.'));
        } else {
            $this->Flash->error(__('The news snippet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	public function ReadMore()
    {
		//print_r($this->request->params);
		$snippet_id = $this->request->params['pass'][0];
		$newsSnippet = $this->NewsSnippets->get($snippet_id, [
            'contain' => ['Users']
        ]);
		$this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('newsSnippets', $this->paginate($this->NewsSnippets));
        $this->set('_serialize', ['newsSnippets']);
        $this->set('newsSnippet', $newsSnippet);
        $this->set('_serialize', ['newsSnippet']);

		$this->viewBuilder()->layout('read_more');
	}
}
