<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Announcements Controller
 *
 * @property \App\Model\Table\AnnouncementsTable $Announcements
 */
class AnnouncementsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Search.Prg', [
			'actions' => ['index']
		]);
		$this->eventManager()->off($this->Csrf);
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
		$query = $this->Announcements
			->find('search', $this->Announcements->filterParams($this->request->query));
		
        $this->paginate = [
            'contain' => ['Users', 'AnnualReports']
        ];
        $this->set('announcements', $this->paginate($query));
        $this->set('_serialize', ['announcements']);
    }

    /**
     * View method
     *
     * @param string|null $id Announcement id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $announcement = $this->Announcements->get($id, [
            'contain' => ['Users', 'AnnualReports']
        ]);
        $this->set('announcement', $announcement);
        $this->set('_serialize', ['announcement']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $announcement = $this->Announcements->newEntity();
		if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$this->request->data['status'] = 1;
            $announcement = $this->Announcements->patchEntity($announcement, $this->request->data);
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
            }
        }
        $users = $this->Announcements->Users->find('list', ['limit' => 200]);
        $annualReports = $this->Announcements->AnnualReports->find('list', ['limit' => 200]);
        $this->set(compact('announcement', 'users', 'annualReports'));
        $this->set('_serialize', ['announcement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Announcement id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $announcement = $this->Announcements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $announcement = $this->Announcements->patchEntity($announcement, $this->request->data);
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
            }
        }
        $users = $this->Announcements->Users->find('list', ['limit' => 200]);
        $annualReports = $this->Announcements->AnnualReports->find('list', ['limit' => 200]);
        $this->set(compact('announcement', 'users', 'annualReports'));
        $this->set('_serialize', ['announcement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $announcement = $this->Announcements->get($id);
        if ($this->Announcements->delete($announcement)) {
            $this->Flash->success(__('The announcement has been deleted.'));
        } else {
            $this->Flash->error(__('The announcement could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
    /**
     * get-company method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getList($id = null)
    {
		$this->autoRender = false;
		if($this->request->data['categoryType'] == 'Annual Report'){
			$lists = $this->Announcements->AnnualReports->find('list', ['keyField'=>'id', 'valueField'=>'name']);
		}else{
			$lists = $this->Announcements->Circulars->find('list', ['keyField'=>'id', 'valueField'=>'name']);
		}
        echo json_encode($lists);
	}    
	
	
	public function reportType($id = null)
    {
		$this->autoRender = false;
		if($this->request->data['reportType'] == 'Annual Report'){
			$companies = $this->Announcements->AnnualReports->find('list', ['group'=>'company_name', 'keyField'=>'id', 'valueField'=>'company_name']);
		}else{
			$companies = $this->Announcements->Circulars->find('list',['group'=>'company_name', 'keyField'=>'id', 'valueField'=>'company_name']);
		}
        echo json_encode($companies);
		exit;
	}
}
