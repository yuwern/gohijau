<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
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
     * User method
     *
     * @return void
     */	
	public function user()
    {
		$this->viewBuilder()->layout('user');
		if($this->Auth->user('is_super_user') != 1){
			$userCompanies = TableRegistry::get('UserCompanies');
			$companiesQuery = $userCompanies->find('all', [
				'contain'=>['AnnualReportUsers'],
				'conditions' => [
					'UserCompanies.user_id' => $this->Auth->user('id'),
					'UserCompanies.type' => 'AnnualReport'
				],
				'fields'=>['AnnualReportUsers.annual_report_id']
			]);	
			$companies = $companiesQuery->toArray();
			$report_ids= [0];
			foreach($companies as $company){
				$report_ids[] = $company['AnnualReportUsers']['annual_report_id'];/*changes*/
			}

			$userCompanies = TableRegistry::get('UserCompanies');
			$companiesQuery = $userCompanies->find('all', [
				'contain'=>['CircularReportUsers'],
				'conditions' => [
					'UserCompanies.user_id' => $this->Auth->user('id'),
					'UserCompanies.type' => 'Circular'
				],
				'fields'=>['CircularReportUsers.circular_id']
			]);	
			$companies = $companiesQuery->toArray();
			$circular_ids= [0];
			foreach($companies as $company){
				$circular_ids[] = $company['CircularReportUsers']['circular_id'];
			}
			
			$events = $this->Events->find('all', [
				'conditions' => [
					'Events.status' => 1,
					'OR' =>[
						['AND'=>['Events.report_id IN ' => $report_ids, 'report_type'=>'AGM']],
						['AND'=>['Events.report_id IN ' => $circular_ids, 'report_type'=>'EGM']],
					],
					'Events.date >' =>date('Y-m-d', strtotime('-1 day'))
				],
				'contain' => ['UsersEvents'],
				'limit' => 30
			]);	
			$events->contain(['UsersEvents' => [
				'strategy' => 'subquery',
				'queryBuilder' => function ($q) {
					return $q->where(['UsersEvents.user_id' => $this->Auth->user('id')]);
				}
			]]);
		}else{
			$events = $this->Events->find('all', [
				'conditions' => [
					'Events.status' => 1,
					'Events.date >' =>date('Y-m-d', strtotime('-1 day'))
				],
				'recursive' => -1
			]);	
		}
		
		$this->paginate = [
            'contain' => ['Users', 'AnnualReports', 'Circulars']
        ];

        $this->set('events', $this->paginate($events));		
        //$this->set('events', $events);	

		$confirmed_events = $this->Events->UsersEvents->find('all')
		->where([
				'Events.status' => 1,
				'Users.id' => $this->Auth->user('id'),
				'Events.date >' =>date('Y-m-d', strtotime('-1 day'))
		])
		->autoFields(true)
		->contain(['Events','Users'])
		->limit(30);
		
		$newsSnippets = TableRegistry::get('newsSnippets');
		$newssnippet_query = $newsSnippets->find('all', [
			'conditions' => [
				'status' => 1
			],
			'order' =>['id' => 'desc']
		]);
		
		$notifications = TableRegistry::get('Notifications');
		$notifications_query = $notifications->find('all', [
			'conditions' => [
				'status' => 1,
				'type' => ''
			],
			'order' =>['id' => 'desc']
		]);
		
        $this->set('news_snippets', $newssnippet_query->all());
        $this->set('notifications', $notifications_query->all());
		
		//$this->set('events', $events);
        $this->set('confirmed_events', $confirmed_events);
        $this->set('_serialize', ['events', 'confirmed_events', 'news_snippets', 'notifications']);
    }
	
    /**
     * Confirm method
     *
     * @return void
     */		
	public function confirm($id = null)
    {
        $event = $this->Events->get($id);
        if (!empty($event)) {
			$userevent = $this->Events->UsersEvents->newEntity();
			$userevent->event_id = $id;
			$userevent->user_id = $this->Auth->user('id');
			$this->Events->UsersEvents->save($userevent);
            $this->Flash->success(__('The event has been confirmed.'));
        } else {
            $this->Flash->error(__('The event not found. Please check'));
        }
        return $this->redirect(['action' => 'user']);
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
		$query = $this->Events
			->find('search', $this->Events->filterParams($this->request->query));
        
		$this->paginate = [
            'contain' => ['Users', 'AnnualReports', 'Circulars']
        ];

        $this->set('events', $this->paginate($query));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Users', 'AnnualReports', 'Circulars']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }
	
    /**
     * get-company method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getCompany($id = null)
    {
		$this->autoRender = false;
		if($this->request->data['eventType'] == 'AGM'){
			$companies = $this->Events->AnnualReports->find('list', ['group'=>'company_name', 'keyField'=>'id', 'valueField'=>'company_name']);
		}else{
			$companies = $this->Events->Circulars->find('list',['group'=>'company_name', 'keyField'=>'id', 'valueField'=>'company_name']);
		}
        echo json_encode($companies);
		exit;
    }

    /**
     * getYear method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getYear($id = null)
    {
		$this->autoRender = false;
		$company_name = $this->request->data['company_name'];
		
		if($this->request->data['eventType'] == 'AGM'){
			$year = $this->Events->AnnualReports->find('list', ['group'=>'report_year', 'keyField'=>'id', 'valueField'=>'report_year', 'conditions' => ['company_name' => $company_name]]);
		}else{
			$year = $this->Events->Circulars->find('list', ['group'=>'circular_year', 'keyField'=>'id', 'valueField'=>'circular_year', 'conditions' => ['company_name' => $company_name]]);
		}
        echo json_encode($year);
		$this->response->statusCode(200);
		exit;
    }

    /**
     * get-reports method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getReports($id = null)
    {
		$this->autoRender = false;
		$year = $this->request->data['year'];
		$company_name = $this->request->data['company_name'];
		if($this->request->data['eventType'] == 'AGM'){
			$companies = $this->Events->AnnualReports->find('list', ['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $company_name, 'report_year'=>$year]]);
		}else{
			$companies = $this->Events->Circulars->find('list',['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $company_name, 'circular_year'=>$year]]);
		}
        echo json_encode($companies);
		$this->response->statusCode(200);
		exit;
    }
	
    public function getReportYear($id = null){
		$this->autoRender = false;
		$company_name = $this->request->data['companyName'];		
		$year = $this->Events->AnnualReports->find('list', ['group'=>'report_year', 'keyField'=>'id', 'valueField'=>'report_year', 'conditions' => ['company_id' => $company_name]]);
        echo json_encode($year);
		$this->response->statusCode(200);
		exit;
	}

    public function getReportEvents($id = null){
		$this->autoRender = false;
		$company_name = $this->request->data['companyName'];		
		$year = $this->request->data['year'];		
		$events = $this->Events->find('list', ['keyField'=>'id', 'valueField'=>'title', 'conditions' => ['year'=>$year, 'company_id' => $company_name]]);
        echo json_encode($events);
		$this->response->statusCode(200);
		exit;
	}
    /**
     * getEvents method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getEvents($id = null)
    {
		if (!empty($this->request->query['year']) && !empty($this->request->query['month'])) {
			if($this->Auth->user('is_super_user') != 1){
				$userCompanies = TableRegistry::get('UserCompanies');
				$companiesQuery = $userCompanies->find('all', [
					'contain'=>['AnnualReportUsers'],
					'conditions' => [
						'UserCompanies.user_id' => $this->Auth->user('id'),
						'UserCompanies.type' => 'AnnualReport'
					],
					'fields'=>['AnnualReportUsers.annual_report_id']
				]);	
				$companies = $companiesQuery->toArray();
				$report_ids= [0];
				foreach($companies as $company){
					$report_ids[] = $company['AnnualReportUsers']['annual_report_id'];/*changes*/
				}

				$userCompanies = TableRegistry::get('UserCompanies');
				$companiesQuery = $userCompanies->find('all', [
					'contain'=>['CircularReportUsers'],
					'conditions' => [
						'UserCompanies.user_id' => $this->Auth->user('id'),
						'UserCompanies.type' => 'Circular'
					],
					'fields'=>['CircularReportUsers.circular_id']
				]);	
				$companies = $companiesQuery->toArray();
				$circular_ids= [0];
				foreach($companies as $company){
					$circular_ids[] = $company['CircularReportUsers']['circular_id'];
				}
				$this->autoRender = false;
				$year = intval($this->request->query['year']);
				$month = intval($this->request->query['month']);
				$events = $this->Events->find('all', ['contain'=>['UsersEvents'],
				'conditions' => [
					'MONTH(Events.date)' => $month, 
					'YEAR(Events.date)'=>$year,
					'OR' =>[
						['AND'=>['report_id IN ' => $report_ids, 'report_type'=>'AGM']],
						['AND'=>['report_id IN ' => $circular_ids, 'report_type'=>'EGM']],
					],				
				]]
				);
			}else{
				$this->autoRender = false;
				$year = intval($this->request->query['year']);
				$month = intval($this->request->query['month']);
				$events = $this->Events->find('all', ['contain'=>['UsersEvents'],
					'conditions' => [
						'MONTH(Events.date)' => $month, 
						'YEAR(Events.date)'=>$year,
					]]
				);		
			}
			$dates = array();
			foreach($events as $i=>$event){
				$dates[$i] = array(
					'date' => date('Y-m-d', strtotime($event['date'])),
					'badge' => (!empty($event['users_events'][0]['id'])) ? true : false,
					'title' => $event['title'].' - '. $event['company_name'],
					'body' => $event['descripiton'],
					'footer' => 'Venue - '.$event['venue'].', Date:'.date('m/d/Y', strtotime($event['date'])).', Time:'.$event['time'],
				);
			}
			echo json_encode($dates);
		} else {
			echo json_encode(array());
		}
		exit;
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$this->request->data['status'] = 1;			
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $AnnualReports = $this->Events->AnnualReports->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users', 'AnnualReports'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }

		if($event->event_type == 'AGM'){
			$companies = $this->Events->AnnualReports->find('list', ['group'=>'company_name', 'keyField'=>'company_name', 'valueField'=>'company_name']);
			$years = $this->Events->AnnualReports->find('list', ['group'=>'report_year', 'keyField'=>'report_year', 'valueField'=>'report_year', 'conditions' => ['company_name' => $event->company_name]]);
			$reports = $this->Events->AnnualReports->find('list', ['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $event->company_name, 'report_year'=>$event->year]]);
		}else{
			$companies = $this->Events->Circulars->find('list',['group'=>'company_name', 'keyField'=>'company_name', 'valueField'=>'company_name']);
			$years = $this->Events->Circulars->find('list', ['group'=>'circular_year', 'keyField'=>'circular_year', 'valueField'=>'circular_year', 'conditions' => ['company_name' => $event->company_name]]);
			$reports = $this->Events->Circulars->find('list',['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $event->company_name, 'circular_year'=>$event->year]]);
		}
        $this->set(compact('event', 'users', 'AnnualReports', 'companies', 'years', 'reports'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
