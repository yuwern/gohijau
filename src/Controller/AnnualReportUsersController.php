<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AnnualReportUsers Controller
 *
 * @property \App\Model\Table\AnnualReportUsersTable $AnnualReportUsers
 */
class AnnualReportUsersController extends AppController
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
		$query = $this->AnnualReportUsers
			->find('search', $this->AnnualReportUsers->filterParams($this->request->query));
			
        $this->paginate = [
			'conditions' =>['annual_report_id' => $id],
            'contain' => ['AnnualReports']
        ];
		
        $this->set('annualReportUsers', $this->paginate($query));
        $this->set('_serialize', ['annualReportUsers']);
    }
	
	
	public function download($user_pdf_file, $annualReportId)
    {
		// Optionally force file download
		//$this->response->download(WWW_ROOT.'files/AnnualReports/shareholder_file_path/pdf/user_'.$id.'.pdf', 'user_'.$id.'.pdf');
		$this->response->file(
			WWW_ROOT."files/AnnualReports/pdf/" . $annualReportId . "/".$user_pdf_file,
			['download' => true, 'name' => $user_pdf_file]
		);
		// Return response object to prevent controller from trying to render
		// a view.
		return $this->response;
    }

    /**
     * View method
     *
     * @param string|null $id Annual Report User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $annualReportUser = $this->AnnualReportUsers->get($id, [
            'contain' => ['AnnualReports']
        ]);
        $this->set('annualReportUser', $annualReportUser);
        $this->set('_serialize', ['annualReportUser']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $annualReportUser = $this->AnnualReportUsers->newEntity();
        if ($this->request->is('post')) {
            $annualReportUser = $this->AnnualReportUsers->patchEntity($annualReportUser, $this->request->data);
            if ($this->AnnualReportUsers->save($annualReportUser)) {
                $this->Flash->success(__('The annual report user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The annual report user could not be saved. Please, try again.'));
            }
        }
        $annualReports = $this->AnnualReportUsers->AnnualReports->find('list', ['limit' => 200]);
        $this->set(compact('annualReportUser', 'annualReports'));
        $this->set('_serialize', ['annualReportUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Annual Report User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $annualReportUser = $this->AnnualReportUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $annualReportUser = $this->AnnualReportUsers->patchEntity($annualReportUser, $this->request->data);
            if ($this->AnnualReportUsers->save($annualReportUser)) {
                $this->Flash->success(__('The annual report user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The annual report user could not be saved. Please, try again.'));
            }
        }
        $annualReports = $this->AnnualReportUsers->AnnualReports->find('list', ['limit' => 200]);
        $this->set(compact('annualReportUser', 'annualReports'));
        $this->set('_serialize', ['annualReportUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Annual Report User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $annualReportUser = $this->AnnualReportUsers->get($id);
        if ($this->AnnualReportUsers->delete($annualReportUser)) {
            $this->Flash->success(__('The annual report user has been deleted.'));
        } else {
            $this->Flash->error(__('The annual report user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
