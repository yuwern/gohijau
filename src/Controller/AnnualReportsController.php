<?php
namespace App\Controller;
use Cake\Validation\Validator;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * AnnualReports Controller
 *
 * @property \App\Model\Table\AnnualReportsTable $AnnualReports
 */
class AnnualReportsController extends AppController
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
		$query = $this->AnnualReports
			->find('search', $this->AnnualReports->filterParams($this->request->query));

		$this->paginate = [
            'contain' => ['Users'],
			'order' =>['id' => 'desc']
        ];
		
        $this->set('annualReports', $this->paginate($query));
        $this->set('_serialize', ['annualReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Annual Report id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $annualReport = $this->AnnualReports->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('annualReport', $annualReport);
        $this->set('_serialize', ['annualReport']);
    }

    /**
     * complete method
     *
     * @return void Redirects on successful complete, renders view otherwise.
     */
    public function complete($id = null)
    {
		$annualReport = $this->AnnualReports->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('annualReport', $annualReport);
        $this->set('_serialize', ['annualReport']);
	}
	
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
        $annualReport = $this->AnnualReports->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$this->request->data['status'] = 1;
            $annualReport = $this->AnnualReports->patchEntity($annualReport, $this->request->data);
            if ($this->AnnualReports->save($annualReport)) {
				$this->Flash->success(__('The annual report has been created successfully.'));
				
				$inputFileName = WWW_ROOT.'files/AnnualReports/shareholder_file_path/'.$annualReport->shareholder_file_path;
				$ext = pathinfo($annualReport->shareholder_file_path, PATHINFO_EXTENSION);
				if($ext == 'xlsx'){
					$objReader = new \PHPExcel_Reader_Excel2007();
				}elseif($ext == 'xls'){
					$objReader = new \PHPExcel_Reader_Excel5();
				}else{
					$objReader = new \PHPExcel_Reader_CSV();
				}
				$success = 0;
				$failed = 0;
				$duplicate = 0;
				$objPHPExcel = $objReader->load($inputFileName);

				$worksheetData = $objReader->listWorksheetInfo($inputFileName);
				$annualReport->total_count = $worksheetData[0]['totalRows']-3;
				$this->AnnualReports->save($annualReport);
				
				ob_implicit_flush(true);
				ob_end_flush();
				
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				if(!empty($sheetData)){
					foreach($sheetData as $k=>$shtData){
						if($k >= 4){
							$status = 'failed';
							if(!empty($shtData['G']) && !empty($shtData['D'])){
								$status = 'success';
								$type = 'AnnualReport';
								$AnnreportUser = TableRegistry::get('AnnualReportUsers');
								$query = $AnnreportUser->find('all', [
									'conditions' => [
										'cds_ac_no' => trim($shtData['D']),
										'icno' => trim($shtData['G']),
									],
								]);
								$ann_user = $query->first();
								if(empty($ann_user)){
									$type = 'Circular';
									$AnnreportUser = TableRegistry::get('CircularReportUsers');
									$query = $AnnreportUser->find('all', [
										'conditions' => [
											'cds_ac_no' => trim($shtData['D']),
											'icno' => trim($shtData['G']),
										]
									]);
									$ann_user = $query->first();
								}							
								$account_qualifiers = preg_replace('/\s\s+/', ' ', $shtData['F']);
								if(!empty($ann_user)){
									if($ann_user->account_qualifiers != $account_qualifiers){
										$this->AnnualReports->generatePdf($shtData, $annualReport->id);
									}else{
										if($ann_user->status != 1){
											$this->AnnualReports->generatePdf($shtData, $annualReport->id);
										}else{
											$duplicate++;
											$status = 'Duplicate';

											$AnnualReportTable = TableRegistry::get('AnnualReportUsers');
											$report = $AnnualReportTable->newEntity();
											$report->annual_report_id = $annualReport->id;
											
											$report->broker_code =  empty($shtData['A'])?'':$shtData['A'];
											$report->broker_type =  empty($shtData['B'])?'':$shtData['B'];
											$report->name_of_broker =  empty($shtData['C'])?'':$shtData['C'];
											$report->cds_ac_no =  empty($shtData['D'])?'':$shtData['D'];
											$report->name_of_shareholders = empty($shtData['E'])?'':$shtData['E'];
											$report->account_qualifiers = empty($shtData['F'])?'':preg_replace('/\s\s+/', ' ', $shtData['F']);
											$report->icno =  empty($shtData['G'])?'':$shtData['G'];
											$report->share_holdings =  empty($shtData['H'])?'':$shtData['H'];
											$AnnualReportTable->save($report);
											
											$userCompanyTable = TableRegistry::get('UserCompanies');
											$query = $userCompanyTable->find()->where(['related_id'=>$ann_user->id, 'type'=>$type]);
											$results = $query->first();
											if(!empty($results)){
												$company = $userCompanyTable->newEntity();
												$company->related_id = $report->id;
												$company->user_id = $results->user_id;
												$company->type = 'AnnaulReport';
												$userCompanyTable->save($company);
											}
										}
									}
								}else{
									if(!empty($shtData['F'])){
										$this->AnnualReports->generatePdf($shtData, $annualReport->id);									
									}else{
										$this->AnnualReports->generatePdf($shtData, $annualReport->id);									
									}
								}
							}else{
								$failed++;
							}
							
							$p = number_format((($k-3)/$annualReport->total_count) * 100, 2);
							$response = array(  'message' => $p . '% Current ICNo: '.$shtData['D'], 
												'progress' => $p);
							
							echo json_encode($response);
						}
					}
				}else{
					$this->Flash->error(__('The annual report have invalid excel file. Please remove and reupload.'));
				}
				$annualReport->failed_count = $duplicate+$failed;
				$this->AnnualReports->save($annualReport);
				
				sleep(1);
				$response = array(  'message' => 'Complete', 
									'progress' => 100);
					
				echo json_encode($response);
                return $this->redirect(['action' => 'complete', $annualReport->id]);
            } else {
				
				$this->Flash->error(__('The annual report could not be saved. Please, try again.'));
            }
        }
        $users = $this->AnnualReports->Users->find('list', ['limit' => 200]);
        $this->set(compact('annualReport', 'users'));
        $this->set('_serialize', ['annualReport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Annual Report id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $annualReport = $this->AnnualReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $annualReport = $this->AnnualReports->patchEntity($annualReport, $this->request->data);
            if ($this->AnnualReports->save($annualReport)) {
                $this->Flash->success(__('The annual report has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The annual report could not be saved. Please, try again.'));
            }
        }
        $users = $this->AnnualReports->Users->find('list', ['limit' => 200]);
        $this->set(compact('annualReport', 'users'));
        $this->set('_serialize', ['annualReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Annual Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $annualReport = $this->AnnualReports->get($id);
        if ($this->AnnualReports->delete($annualReport)) {
            $this->Flash->success(__('The annual report has been deleted.'));
        } else {
            $this->Flash->error(__('The annual report could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	
	public function download($id, $name)
    {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');		
		// Get real path for our folder
		$rootPath = realpath('files/AnnualReports/pdf/'.$id.'/');

		if(is_dir($rootPath)){
		
			$zip = new \ZipArchive();
			$zip->open('files/zip/'.$id.'.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

			$files = new \RecursiveIteratorIterator(
				new \RecursiveDirectoryIterator($rootPath),
				\RecursiveIteratorIterator::LEAVES_ONLY
			);

			foreach ($files as $name => $file)
			{
				// Skip directories (they would be added automatically)
				if (!$file->isDir())
				{
					// Get real and relative path for current file
					$filePath = $file->getRealPath();
					$relativePath = substr($filePath, strlen($rootPath) + 1);

					// Add current file to archive
					$zip->addFile($filePath, $relativePath);
				}
			}

			// Zip archive will be created only after closing object
			$zip->close();		
			
			$this->response->file(
				WWW_ROOT.'files/zip/'.$id.'.zip',
				['download' => true, 'name' => $name.$id.'.zip']
			);
			return $this->response;
		}else{
            $this->Flash->error(__('Files are not found. Please remove the record and add as a new Circular.'));
			return $this->redirect(['action' => 'index']);
		}			
    }
	
	public function userView($id)
    {
		$this->viewBuilder()->layout('user');
        $annualReport = $this->AnnualReports->get($id, [
            'contain' => ['Companies']
        ]);

		$userViewsTable = TableRegistry::get('UserViews');
		$query = $userViewsTable->find()->where(['user_id'=>$this->Auth->user('id'),'report_type'=>'AnnaulReport', 'report_id'=>$id ]);
		$userViews = $query->first();
		if(empty($userViews)){
			$userViews = $userViewsTable->newEntity();
			$userViews->user_id = $this->Auth->user('id');
			$userViews->report_id = $id;
			$userViews->report_type = 'AnnaulReport';
			$userViews->is_view = 1;
			$userViewsTable->save($userViews);
		}else{
			$userViews->is_view = 1;
			$userViewsTable->save($userViews);			
		}
		
        $this->set('annualReport', $annualReport);
        $this->set('_serialize', ['annualReport']);
    }
	
	public function reportDownload($id)
    {
		$userViewsTable = TableRegistry::get('UserViews');
		$query = $userViewsTable->find()->where(['user_id'=>$this->Auth->user('id'),'report_type'=>'AnnaulReport', 'report_id'=>$id ]);
		$userViews = $query->first();
		if(empty($userViews)){
			$userViews = $userViewsTable->newEntity();
			$userViews->user_id = $this->Auth->user('id');
			$userViews->report_id = $id;
			$userViews->report_type = 'AnnaulReport';
			$userViews->is_download = 1;
			$userViewsTable->save($userViews);
		}else{
			$userViews->is_download = 1;
			$userViewsTable->save($userViews);			
		}
		
		$annualReport = $this->AnnualReports->get($id);
		$this->response->file(
			WWW_ROOT.'files/AnnualReports/report_pdf_file_path/'.$annualReport->report_pdf_file_path,
			['download' => true, 'name' => $annualReport->name.'.pdf']
		);
		return $this->response;
	}
}
