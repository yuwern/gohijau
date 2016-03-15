<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 */
class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
		$this->Auth->allow(['home', 'index', 'contact', 'features', 'about', 'announcement','privacy','terms']);
		$this->loadComponent('Search.Prg', [
			'actions' => ['index']
		]);
    }
	
    /**
     * Index method
     *
     * @return void
     */
    public function home($slug = null)
    {
		
		$this->viewBuilder()->layout('default');
		$this->set('pages', $this->paginate($this->Pages));
		$this->set('_serialize', ['pages']);
    }
	
	    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
	$query = $this->Pages
			->find('search', $this->Pages->filterParams($this->request->query));
        $this->set('pages', $this->paginate($query));
        $this->set('_serialize', ['pages']);
    }   

	/**
     * Feature method
     *
     * @return void
     */
    public function features()
    {
		$this->viewBuilder()->layout('default');
		$this->render('feature');
    }

	/**
     * Feature method
     *
     * @return void
     */
    public function about()
    {
		$this->viewBuilder()->layout('default');
		$page = TableRegistry::get('Pages');
		$query = $page->find('all', [
			'conditions' => ['slug' => 'about']
		]);
		$page = $query->first();
		$this->set('page', $page);			
		$this->set('_serialize', ['page']);
		$this->render('page_new');		
    }
	public function privacy()
    {
		$this->viewBuilder()->layout('default');
		$page = TableRegistry::get('Pages');
		$query = $page->find('all', [
			'conditions' => ['slug' => 'privacy']
		]);
		$page = $query->first();
		$this->set('page', $page);			
		$this->set('_serialize', ['page']);
		$this->render('page_new');		
    }
	public function terms()
    {
		$this->viewBuilder()->layout('default');
		$page = TableRegistry::get('Pages');
		$query = $page->find('all', [
			'conditions' => ['slug' => 'terms']
		]);
		$page = $query->first();
		$this->set('page', $page);			
		$this->set('_serialize', ['page']);
		$this->render('page_new');		
    }
	
	 public function announcement()
    {
		$this->viewBuilder()->layout('default');
		$announcement = TableRegistry::get('Announcements');
		//$query = $announcement->find('all');
		 $query = $this->Announcements->Users->find();
		//print_r($query);
		//$annoument_values[] = $query->first();
		
        $this->set('announcements', $annoument_values);
		$this->set('_serialize', ['page']);
		$this->render('announcement');		
    }

    /**
     * View method
     *
     * @param string|null $id Page id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $page = $this->Pages->newEntity();
        if ($this->request->is('post')) {
            $page = $this->Pages->patchEntity($page, $this->request->data);
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('page'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->data);
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('page'));
        $this->set('_serialize', ['page']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
