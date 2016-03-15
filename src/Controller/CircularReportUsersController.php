<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CircularReportUsers Controller
 *
 * @property \App\Model\Table\CircularReportUsersTable $CircularReportUsers
 */
class CircularReportUsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Search.Prg', [
			'actions' => ['index']
		]);
	}
    /**
     * Index method
     *
     * @return void
     */
    public function index($id)
    {
		$query = $this->CircularReportUsers
			->find('search', $this->CircularReportUsers->filterParams($this->request->query));
			
        $this->paginate = [
			'conditions' =>['circular_id' => $id]
        ];
        $this->set('circularReportUsers', $this->paginate($query));
        $this->set('_serialize', ['circularReportUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Circular Report User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $circularReportUser = $this->CircularReportUsers->get($id, [
            'contain' => ['Circulars']
        ]);
        $this->set('circularReportUser', $circularReportUser);
        $this->set('_serialize', ['circularReportUser']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $circularReportUser = $this->CircularReportUsers->newEntity();
        if ($this->request->is('post')) {
            $circularReportUser = $this->CircularReportUsers->patchEntity($circularReportUser, $this->request->data);
            if ($this->CircularReportUsers->save($circularReportUser)) {
                $this->Flash->success(__('The circular report user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The circular report user could not be saved. Please, try again.'));
            }
        }
        $circulars = $this->CircularReportUsers->Circulars->find('list', ['limit' => 200]);
        $this->set(compact('circularReportUser', 'circulars'));
        $this->set('_serialize', ['circularReportUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Circular Report User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $circularReportUser = $this->CircularReportUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $circularReportUser = $this->CircularReportUsers->patchEntity($circularReportUser, $this->request->data);
            if ($this->CircularReportUsers->save($circularReportUser)) {
                $this->Flash->success(__('The circular report user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The circular report user could not be saved. Please, try again.'));
            }
        }
        $circulars = $this->CircularReportUsers->Circulars->find('list', ['limit' => 200]);
        $this->set(compact('circularReportUser', 'circulars'));
        $this->set('_serialize', ['circularReportUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Circular Report User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $circularReportUser = $this->CircularReportUsers->get($id);
        if ($this->CircularReportUsers->delete($circularReportUser)) {
            $this->Flash->success(__('The circular report user has been deleted.'));
        } else {
            $this->Flash->error(__('The circular report user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	
	public function download($user_pdf_file, $annualReportId)
    {
		// Optionally force file download
		//$this->response->download(WWW_ROOT.'files/AnnualReports/shareholder_file_path/pdf/user_'.$id.'.pdf', 'user_'.$id.'.pdf');
		$this->response->file(
			WWW_ROOT."files/Circulars/pdf/" . $annualReportId . "/".$user_pdf_file,
			['download' => true, 'name' => $user_pdf_file]
		);
		// Return response object to prevent controller from trying to render
		// a view.
		return $this->response;
    }
	
}
