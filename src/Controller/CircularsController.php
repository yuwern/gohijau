<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Circulars Controller
 *
 * @property \App\Model\Table\CircularsTable $Circulars
 */
class CircularsController extends AppController
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
    public function index()
    {
		$query = $this->Circulars
			->find('search', $this->Circulars->filterParams($this->request->query));
        $this->paginate = [
            'contain' => ['Users']
        ];
        //$this->set('circulars', $this->paginate($this->Circulars));
        $this->set('circulars', $this->paginate($query));
        $this->set('_serialize', ['circulars']);
    }

    /**
     * View method
     *
     * @param string|null $id Circular id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $circular = $this->Circulars->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('circular', $circular);
        $this->set('_serialize', ['circular']);
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
        $circular = $this->Circulars->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$this->request->data['status'] = 1;

			
            $circular = $this->Circulars->patchEntity($circular, $this->request->data);
            if ($this->Circulars->save($circular)) {
                $this->Flash->success(__('The circular has been saved.'));
					
					$inputFileName = WWW_ROOT.'files/Circulars/shareholder_list_file/'.$circular->shareholder_list_file;
					$ext = pathinfo($circular->shareholder_list_file, PATHINFO_EXTENSION);
					if($ext == 'xlsx'){
						$objReader = new \PHPExcel_Reader_Excel2007();
					}elseif($ext == 'xls'){
						$objReader = new \PHPExcel_Reader_Excel5();
					}else{
						$objReader = new \PHPExcel_Reader_CSV();
					}
						
					$worksheetData = $objReader->listWorksheetInfo($inputFileName);
					$circular->total_count = $worksheetData[0]['totalRows']-3;
					$this->Circulars->save($circular);
				
					ob_implicit_flush(true);
					ob_end_flush();
				
					$success = 0;
					$failed = 0;
					$objPHPExcel = $objReader->load($inputFileName);
					$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					foreach($sheetData as $k=>$shtData){
						if($k >= 4){
							$status = 'failed';
							if(!empty($shtData['G'])){
								$success++;
								$status = 'success';
								$type = 'Circular';
								$AnnreportUser = TableRegistry::get('CircularReportUsers');
								$query = $AnnreportUser->find('all', [
									'conditions' => [
										'cds_ac_no' => trim($shtData['D']),
										'icno' => trim($shtData['G']),
										//'AnnualReports.company_id' => $annualReport->company_id,
									],
									//'contain' =>['AnnualReports']
								]);
								$ann_user = $query->first();
								if(empty($ann_user)){
									$type = 'AnnualReport';
									$AnnreportUser = TableRegistry::get('AnnualReportUsers');
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
										$this->Circulars->generatePdf($shtData, $circular->id, $circular->subject);			
									}else{
										if($ann_user->status != 1){
											$this->Circulars->generatePdf($shtData, $circular->id, $circular->subject);			
										}else{

											$status = 'Duplicate';
											$failed++;
											
											$AnnualReportTable = TableRegistry::get('CircularReportUsers');
											$report = $AnnualReportTable->newEntity();
											$report->circular_id = $circular->id;
											
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
												$userCompany = $userCompanyTable->newEntity();
												$userCompany->related_id = $report->id;
												$userCompany->user_id = $results->user_id;
												$userCompany->type = 'Circular';
												$userCompanyTable->save($userCompany);
											}
										}
									}
								}else{
									if(!empty($shtData['F'])){
										$this->Circulars->generatePdf($shtData, $circular->id, $circular->subject);									
									}else{
										$this->Circulars->generatePdf($shtData, $circular->id, $circular->subject);									
									}
								}
							}else{
								$failed++;
							}	
							
							$p = number_format((($k-3)/$circular->total_count) * 100, 2);
							$response = array(  'message' => $p . '% Row No: '.$k. '- '.$status, 
												'progress' => $p);
							
							echo json_encode($response);							
						}
					}
				
				$circular->failed_count = $failed;
				$this->Circulars->save($circular);
				
				sleep(1);
				$response = array(  'message' => 'Complete', 
									'progress' => 100);
					
				echo json_encode($response);
				
                return $this->redirect(['action' => 'complete', $circular->id]);
            } else {
                $this->Flash->error(__('The circular could not be saved. Please, try again.'));
            }
        }
        $users = $this->Circulars->Users->find('list', ['limit' => 200]);
        $this->set(compact('circular', 'users'));
        $this->set('_serialize', ['circular']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Circular id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $circular = $this->Circulars->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $circular = $this->Circulars->patchEntity($circular, $this->request->data);
            if ($this->Circulars->save($circular)) {
                $this->Flash->success(__('The circular has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The circular could not be saved. Please, try again.'));
            }
        }
        $users = $this->Circulars->Users->find('list', ['limit' => 200]);
        $this->set(compact('circular', 'users'));
        $this->set('_serialize', ['circular']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Circular id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $circular = $this->Circulars->get($id);
        if ($this->Circulars->delete($circular)) {
            $this->Flash->success(__('The circular has been deleted.'));
        } else {
            $this->Flash->error(__('The circular could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
    /**
     * complete method
     *
     * @return void Redirects on successful complete, renders view otherwise.
     */
    public function complete($id = null)
    {
		$circular = $this->Circulars->get($id);
        $this->set('circular', $circular);
        $this->set('_serialize', ['circular']);
	}

    /**
     * download method
     *
     * @return void Redirects on download.
     */	
	public function download($id, $name)
    {
		set_time_limit(0);
		ini_set('memory_limit', '1024M');		
		// Get real path for our folder
		$rootPath = realpath('files/Circulars/pdf/'.$id.'/');
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
				['download' => true, 'name' => $id.'.zip']
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
        $circular = $this->Circulars->get($id, [
            'contain' => ['Companies']
        ]);
		$userViewsTable = TableRegistry::get('UserViews');
		$query = $userViewsTable->find()->where(['user_id'=>$this->Auth->user('id'),'report_type'=>'AnnaulReport', 'report_id'=>$id ]);
		$userViews = $query->first();
		if(empty($userViews)){
			$userViews = $userViewsTable->newEntity();
			$userViews->user_id = $this->Auth->user('id');
			$userViews->report_id = $id;
			$userViews->report_type = 'Circular';
			$userViews->is_view = 1;
			$userViewsTable->save($userViews);
		}else{
			$userViews->is_view = 1;
			$userViewsTable->save($userViews);			
		}

        $this->set('circular', $circular);
        $this->set('_serialize', ['circular']);
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
			$userViews->report_type = 'Circular';
			$userViews->is_download = 1;
			$userViewsTable->save($userViews);
		}else{
			$userViews->is_download = 1;
			$userViewsTable->save($userViews);			
		}

		$annualReport = $this->Circulars->get($id);
		$this->response->file(
			WWW_ROOT.'files/Circulars/report_pdf_file_path/'.$annualReport->report_pdf_file_path,
			['download' => true, 'name' => $annualReport->name.'.pdf']
		);
		return $this->response;
	}	
}
