<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	
	/**
     * Initialize method
     *
     * @return void
     */	
	 
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Search.Prg', [
			'actions' => ['index', 'userIndex']
		]);
		$this->Auth->allow(['login', 'proceed', 'resetPasswordRegister', 'resetPassword', 'register', 'logout','registerStep2', 'verifyEmail', 'registerLogin', 'adminLogin','forgotPassword']);
	}
	
	/**
     * Login method
     *
     * @return void
     */	
	public function login()
	{
		/*
		$sid = "ACef7ae7f3da8075d696d8c9fdb2b00259";
		$token = "eb50d4935fece62655da4f407baecb5d";
		
		$http = new \Services_Twilio_TinyHttp(
			'https://api.twilio.com',
			array('curlopts' => array(
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => 2,
			))
		);

		$client = new \Services_Twilio($sid, $token, date('Y-m-d'), $http);
		//$client = new \Services_Twilio($sid, $token);
		$message = $client->account->messages->sendMessage(
			'+14243431198', // From a valid Twilio number
			'+919843270710', // Text this number
			"Hello Gohijau!"
		);	
		pr($message); exit;
		
		
		$client = new \Services_Twilio($sid, $token);
		$message = $client->account->messages->sendMessage(
			'+15005550006', // From a valid Twilio number
			'+919843270710', // Text this number
			"Hello ".$user->username.". Welcome to Gohiju. Passcode: 584785"
		);
		return $message;
exit;	*/	
		$this->viewBuilder()->layout(false);
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				if($user['role'] == 'admin'){
					$this->Flash->error(__('Invalid username or password, try again'));
					$this->Auth->logout();
					return $this->redirect($this->referer());
				}
				if($user['active'] != 1){
					$this->Flash->error(__('Account is deactivated. Please check the admin.'));
					$this->Auth->logout();
					return $this->redirect($this->referer());
				}
				
				$this->Auth->setUser($user);
				
				$userLoginTable = TableRegistry::get('UserLogins');
				$userLogin = $userLoginTable->newEntity();
				$userLogin->user_id = $user['id'];
				$userLoginTable->save($userLogin);
				return $this->redirect(['controller'=>'users', 'action'=>'dashboard']);
			}
			
			$this->Flash->error(__('Invalid username or password, try again'));
			return $this->redirect($this->referer());
		}
	}		
	/**
     * ADmin Login method
     *
     * @return void
     */	
	public function adminLogin()
	{
		$this->viewBuilder()->layout('login');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				if($user['role'] != 'admin'){
					$this->Flash->error(__('Invalid username or password, try again'));
					$this->Auth->logout();
					return $this->redirect($this->referer());
				}
				$this->Auth->setUser($user);
				$userLoginTable = TableRegistry::get('UserLogins');
				$userLogin = $userLoginTable->newEntity();
				$userLogin->user_id = $user['id'];
				$userLoginTable->save($userLogin);				
				return $this->redirect(['controller'=>'users', 'action'=>'index']);
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}
	/**
     * Register Login method
     *
     * @return void
     */	
	public function registerLogin($token)
	{
		$this->viewBuilder()->layout('register');
        $query = $this->Users->find('all', [
			'conditions' => ['Users.token' => $token]
		]);
		$user = $query->first();
		$this->set('user', $user);
		if(!empty($user)){
			if ($this->request->is(['patch', 'put'])) {
				$userRecord = $this->Auth->identify();
				if ($userRecord) {
					$this->Auth->setUser($userRecord);
					$userCompany =  $this->Users->UserCompanies->newEntity();
					$userCompany->user_id = $userRecord['id'];
					$userCompany->related_id = $this->request->session()->read('report_id');
					$userCompany->type =  $this->request->session()->read('report_type');
					$this->Users->UserCompanies->save($userCompany);
					
					if($this->request->session()->read('report_type') == 'Circular'){
						$AnnreportUser = TableRegistry::get('CircularReportUsers');
					}else{
						$AnnreportUser = TableRegistry::get('AnnualReportUsers');
					}
					$query = $AnnreportUser->find('all', [
						'conditions' => [
							'id' => $userCompany->related_id
						]
					]);
					$ann_user = $query->first();
					$ann_user->status = 1;
					$AnnreportUser->save($ann_user);				
					
					$user->token = '';
					$user->status = 1;
					$user->token_expires = '0000-00-00 00:00:00';
					$this->Users->save($user);
				
					return $this->redirect(['controller'=>'users', 'action'=>'dashboard']);
				}else{
					return $this->redirect(['controller'=>'users', 'action'=>'reset-password-register', $token]);
				}
				$this->Flash->error(__('Invalid username or password, try again'));
			}
		}else{
			throw new NotFoundException(__('Expired Link or User'));
		}
	}
    
	/**
     * Logout method
     *
     * @return void
     */
	public function logout()
	{
		if($this->Auth->user('role') == 'admin'){
			$this->Auth->logout();
			return $this->redirect(['controller'=>'users', 'action'=>'adminLogin']);
		}else{
			$this->Auth->logout();
			return $this->redirect('/');		
		}
		//return $this->redirect($this->Auth->logout());
	}
	
    /**
     * Dashboard method
     *
     * @return void
     */
    public function dashboard()
    {
		$this->viewBuilder()->layout('user');

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
        $this->set('_serialize', ['annual_reports', 'circulars', 'news_snippets', 'notifications']);
    }
	
	public function getAnnualReports() {
		$this->autoRender = false;
		$this->viewBuilder()->layout('ajax');
		
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
				$report_ids[] = $company['AnnualReportUsers']['annual_report_id'];
			}
			
			$annual_reports = TableRegistry::get('AnnualReports');
			$query = $annual_reports->find('all', [
				'contain'=>['Companies'],
				'conditions' => [
					'AnnualReports.status' => 1,
					'AnnualReports.id IN ' => $report_ids,
				],
				'order' => ['AnnualReports.id'=>'desc']
			]);	
		}else{
			$annual_reports = TableRegistry::get('AnnualReports');
			$query = $annual_reports->find('all', [
				'contain'=>['Companies'],
				'conditions' => [
					'AnnualReports.status' => 1
				],
				'order' => ['AnnualReports.id'=>'desc']
			]);	
			
			$circulars = TableRegistry::get('Circulars');
			$circular_query = $circulars->find('all', [
				'contain'=>['Companies'],
				'conditions' => [
					'Circulars.status' => 1
				]
			]);
		}
		$this->paginate = ['limit' => 10];
		$this->set('annual_reports',  $this->paginate($query));
		$this->render('annual_reports');
	}		
	
	public function circulars() {
		$this->autoRender = false;
		$this->viewBuilder()->layout('ajax');
		if($this->Auth->user('is_super_user') != 1){
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
			
			$circulars = TableRegistry::get('Circulars');
			$circular_query = $circulars->find('all', [
				'contain'=>['Companies'],
				'conditions' => [
					'Circulars.status' => 1,
					'Circulars.id IN ' => $circular_ids,
				]
			]);	
		}else{
			$circulars = TableRegistry::get('Circulars');
			$circular_query = $circulars->find('all', [
				'contain'=>['Companies'],
				'conditions' => [
					'Circulars.status' => 1
				]
			]);
			$this->paginate = ['limit' => 10];
			$this->set('circulars',  $this->paginate($circular_query));
		}
		$this->render('circulars');
	}	
	
	 public function announcement()
    {
		$this->viewBuilder()->layout('user');
		$announcements = TableRegistry::get('Announcements');
		$annualReportUsers = TableRegistry::get('AnnualReportUsers');
		$conditions = [] ;
		if(!empty($this->request->query['keyword'])){
			$conditions['Announcements.content LIKE'] = '%'.$this->request->query['keyword'].'%';
		}
		if(!empty($this->request->query['year'])){
			$conditions['YEAR(Announcements.created) LIKE'] = '%'.$this->request->query['year'].'%';
		}
		 if(!empty($this->request->query['category_type'])){
			$conditions['Announcements.category_type LIKE'] = '%'.$this->request->query['category_type'].'%';
		}
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
				$report_ids[] = $company['AnnualReportUsers']['annual_report_id'];
			}
			$conditions['Announcements.related_id IN '] = $report_ids;
		}
		
		$query = $announcements->find('all', [
			'contain'=>['Users','AnnualReports','AnnualReportUsers'],
			'conditions' => $conditions
		]);		
		$this->paginate = ['limit' => 10];
  
        $this->set('announcements', $this->paginate($query));
		$this->set('_serialize', ['announcements']);
    }
	
	public function accountSetting()
    {
		$login_id = $this->request->session()->read('Auth.User.id');
		$user = $this->Users->get($login_id, [
            'contain' => []
        ]);
		if ($this->request->is(['patch', 'post', 'put']) && $this->request->data['button'] == 'Update Profile') {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The account profile has been updated.'), ['key' => 'profile']);
                return $this->redirect(['action' => 'account_setting']);
            } else {
                $this->Flash->error(__('The user could not be updated. Please, try again.'), ['key' => 'profile']);
            }
        }
		elseif ($this->request->is(['patch', 'post', 'put']) && $this->request->data['button'] == 'Change Password') {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user['password'] = $this->request->data['new_password'];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The password has been changed.'), ['key' => 'password']);
                return $this->redirect(['action' => 'account_setting']);
            } else {
                $this->Flash->error(__('The password could not be updated. Please, try again.'), ['key' => 'password']);
            }
        }
		
		
        $this->set('user', $user);
		$this->viewBuilder()->layout('user');
		
    }
	public function annualReport($id = null)
	{
		$this->viewBuilder()->layout('user');
	}
	
	public function report()
    {
		if(!empty($this->request->query['active_users'])){
			$query = TableRegistry::get('Users')->find();
			$query->where(['Users.active' => 1]);
			$users = $this->paginate($query);
			$this->set('users', $users);
			$this->set('_serialize', ['users']);
		}else if(!empty($this->request->query['verfied_users'])){
			$query = TableRegistry::get('Users')->find();
			$query->where(['Users.is_phone_verified' => 1]);
			$query->where(['Users.is_email_verified' => 1]);
			$users = $this->paginate($query);
			$this->set('users', $users);
			$this->set('_serialize', ['users']);
		}else if(!empty($this->request->query['user_logins'])){
			$query = TableRegistry::get('UserLogins');
			$this->paginate = [
				'contain' => ['Users']
			];			
			$user_logins = $this->paginate($query->find());
			$this->set('user_logins', $user_logins);
		}else if(!empty($this->request->query['rsvp'])){
			$query = TableRegistry::get('UsersEvents')->find();
			$query->where([
				'Events.id' =>$this->request->query['event_id_new'],
			]);			
			$this->paginate = [
				'contain' => ['Users', 'Events']
			];
			$events = $this->paginate($query);
			$this->loadModel('Events');
			
			$event = $this->Events->get($this->request->query['event_id_new']);			
			if($event->event_type == 'AGM'){
				$companies = $this->Events->AnnualReports->find('list', ['group'=>'company_name', 'keyField'=>'id', 'valueField'=>'company_name']);
				$years = $this->Events->AnnualReports->find('list', ['group'=>'report_year', 'keyField'=>'report_year', 'valueField'=>'report_year', 'conditions' => ['company_name' => $event->company_name]]);
				$reports = $this->Events->find('list', ['keyField'=>'id', 'valueField'=>'title', 'conditions' => ['company_name' => $event->company_name, 'year'=>$event->year]]);
			}else{
				$companies = $this->Events->Circulars->find('list',['group'=>'company_name', 'keyField'=>'id', 'valueField'=>'company_name']);
				$years = $this->Events->Circulars->find('list', ['group'=>'circular_year', 'keyField'=>'circular_year', 'valueField'=>'circular_year', 'conditions' => ['company_name' => $event->company_name]]);
				$reports = $this->Events->find('list', ['keyField'=>'id', 'valueField'=>'title', 'conditions' => ['company_name' => $event->company_name, 'year'=>$event->year]]);
			}
			$this->set(compact('event', 'users', 'AnnualReports', 'companies', 'years', 'reports'));
			
			$this->set('events', $events);
			
		}else if(!empty($this->request->query['list_of_users_report'])){
			$query = TableRegistry::get('UserViews')->find();
			$query->where([
				'UserViews.report_id' =>$this->request->query['report_id'],
				'UserViews.is_view' =>1,
				'UserViews.report_type' =>'AnnaulReport',
			]);			
			$this->paginate = [
				'contain' => ['Users']
			];
			$events = $this->paginate($query);
			$this->set('events', $events);
			$this->loadModel('AnnualReports');
			$event = $this->AnnualReports->get($this->request->query['report_id']);	
			$companies = $this->AnnualReports->find('list', ['group'=>'company_name', 'keyField'=>'company_name', 'valueField'=>'company_name']);
			$years = $this->AnnualReports->find('list', ['group'=>'report_year', 'keyField'=>'report_year', 'valueField'=>'report_year', 'conditions' => ['company_name' => $event->company_name]]);
			$reports = $this->AnnualReports->find('list', ['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $event->company_name, 'report_year'=>$event->report_year]]);
			$this->set(compact('event', 'users', 'AnnualReports', 'companies', 'years', 'reports'));

			
		}else if(!empty($this->request->query['downloads_of_users_report'])){
			$query = TableRegistry::get('UserViews')->find();
			$query->where([
				'UserViews.report_id' =>$this->request->query['report_id'],
				'UserViews.is_download' =>1,
				'UserViews.report_type' =>'AnnaulReport',
			]);			
			$this->paginate = [
				'contain' => ['Users']
			];
			$events = $this->paginate($query);
			$this->set('events', $events);
			$this->loadModel('AnnualReports');
			$event = $this->AnnualReports->get($this->request->query['report_id']);	
			$companies = $this->AnnualReports->find('list', ['group'=>'company_name', 'keyField'=>'company_name', 'valueField'=>'company_name']);
			$years = $this->AnnualReports->find('list', ['group'=>'report_year', 'keyField'=>'report_year', 'valueField'=>'report_year', 'conditions' => ['company_name' => $event->company_name]]);
			$reports = $this->AnnualReports->find('list', ['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $event->company_name, 'report_year'=>$event->report_year]]);
			$this->set(compact('event', 'users', 'AnnualReports', 'companies', 'years', 'reports'));
			
		}else if(!empty($this->request->query['readed_report'])){
			$query = TableRegistry::get('UserViews')->find();
			$query->where([
				'UserViews.report_id' =>$this->request->query['report_id'],
				'UserViews.is_view' =>1,
				'UserViews.report_type' =>'Circular',
			]);			
			$this->paginate = [
				'contain' => ['Users']
			];
			$events = $this->paginate($query);
			$this->set('events', $events);
			$this->loadModel('Circulars');
			$event = $this->Circulars->get($this->request->query['report_id']);	
			$companies = $this->Circulars->find('list', ['group'=>'company_name', 'keyField'=>'company_name', 'valueField'=>'company_name']);
			$years = $this->Circulars->find('list', ['group'=>'circular_year', 'keyField'=>'circular_year', 'valueField'=>'circular_year', 'conditions' => ['company_name' => $event->company_name]]);
			$reports = $this->Circulars->find('list', ['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $event->company_name, 'circular_year'=>$event->circular_year]]);
			$this->set(compact('event', 'users', 'Circulars', 'companies', 'years', 'reports'));
			
		}else if(!empty($this->request->query['downloaded_report'])){
			$query = TableRegistry::get('UserViews')->find();
			$query->where([
				'UserViews.report_id' =>$this->request->query['report_id'],
				'UserViews.is_download' =>1,
				'UserViews.report_type' =>'AnnaulReport',
			]);			
			$this->paginate = [
				'contain' => ['Users']
			];
			$events = $this->paginate($query);
			$this->set('events', $events);
			$this->loadModel('Circulars');
			$event = $this->Circulars->get($this->request->query['report_id']);	
			$companies = $this->Circulars->find('list', ['group'=>'company_name', 'keyField'=>'company_name', 'valueField'=>'company_name']);
			$years = $this->Circulars->find('list', ['group'=>'circular_year', 'keyField'=>'circular_year', 'valueField'=>'circular_year', 'conditions' => ['company_name' => $event->company_name]]);
			$reports = $this->Circulars->find('list', ['keyField'=>'id', 'valueField'=>'name', 'conditions' => ['company_name' => $event->company_name, 'circular_year'=>$event->circular_year]]);
			$this->set(compact('event', 'users', 'Circulars', 'companies', 'years', 'reports'));			
		}
		
		if(!empty($query) && !empty($this->request->query['type']) && $this->request->query['type'] == 'pdf'){
			$data = [];
			if(!empty($this->request->query['user_logins'])){
				$title = 'user_logins';
				$title_row = ['Username', 'Email', 'Date'];
				$posts = $query->find()->contain(['Users'])->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->user->username;
					$data[$key]['email']=$post->user->email;
					$data[$key]['activation_date']=$post->created->format('m/d/Y H:i:s');
				}				
			}elseif(!empty($this->request->query['list_of_users_report']) ||!empty($this->request->query['downloaded_report']) ||!empty($this->request->query['readed_report']) ||!empty($this->request->query['downloads_of_users_report'])){
				$title = $this->request->query['list_of_users_report'];
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Date'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->user->username;
					$data[$key]['email']=$post->user->email;
					$data[$key]['phone']=$post->user->phone;
					$data[$key]['activation_date']=$post->user->activation_date;
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
				}				
			}else if(!empty($this->request->query['active_users'])){
				$title = 'active_users';
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Date'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->username;
					$data[$key]['email']=$post->email;
					$data[$key]['phone']=$post->phone;
					$data[$key]['activation_date']=$post->activation_date;
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
				}					
			}else if(!empty($this->request->query['verfied_users'])){
				$title = 'verfied_users';
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Phone Verified', 'Email Verified', 'Date', 'Status'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->username;
					$data[$key]['email']=$post->email;
					$data[$key]['phone']=$post->phone;
					$data[$key]['activation_date']=$post->activation_date;
					$data[$key]['phone_verified']=($post->is_phone_verified==1)?'Yes':'No';
					$data[$key]['email_verified']=($post->is_email_verified==1)?'Yes':'No';
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
					$data[$key]['active']=($post->active==1)?'Yes':'No';
				}				
			}else if(!empty($this->request->query['rsvp'])){
				$title = 'rsvp';
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Phone Verified', 'Email Verified', 'Date', 'Status'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->user->username;
					$data[$key]['email']=$post->user->email;
					$data[$key]['phone']=$post->user->phone;
					$data[$key]['activation_date']=$post->user->activation_date;
					$data[$key]['phone_verified']=($post->user->is_phone_verified==1)?'Yes':'No';
					$data[$key]['email_verified']=($post->user->is_email_verified==1)?'Yes':'No';
					$data[$key]['date']=$post->user->created->format('Y-m-d H:i:s');;
					$data[$key]['active']=($post->user->active==1)?'Yes':'No';
				}
			}

			$this->createPdf($title, $data);
			exit;
		}
		if(!empty($query) && !empty($this->request->query['type']) && $this->request->query['type'] == 'excel'){
			$data = [];
			if(!empty($this->request->query['user_logins'])){
				$title = 'user_logins';
				$title_row = ['Username', 'Email', 'Date'];
				$posts = $query->find()->contain(['Users'])->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->user->username;
					$data[$key]['email']=$post->user->email;
					$data[$key]['activation_date']=$post->created->format('m/d/Y H:i:s');
				}				
			}else if(!empty($this->request->query['verfied_users'])){
				$title = 'verfied_users';
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Phone Verified', 'Email Verified', 'Date', 'Status'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->username;
					$data[$key]['email']=$post->email;
					$data[$key]['phone']=$post->phone;
					$data[$key]['activation_date']=$post->activation_date;
					$data[$key]['phone_verified']=($post->is_phone_verified==1)?'Yes':'No';
					$data[$key]['email_verified']=($post->is_email_verified==1)?'Yes':'No';
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
					$data[$key]['active']=($post->active==1)?'Yes':'No';
				}
			}else if(!empty($this->request->query['active_users'])){
				$title = 'active_users';
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Date'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->username;
					$data[$key]['email']=$post->email;
					$data[$key]['phone']=$post->phone;
					$data[$key]['activation_date']=$post->activation_date;
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
				}			
			}elseif(!empty($this->request->query['list_of_users_report']) ||!empty($this->request->query['downloaded_report']) ||!empty($this->request->query['readed_report']) ||!empty($this->request->query['downloads_of_users_report'])){
				$title = $this->request->query['list_of_users_report'];
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Date'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->user->username;
					$data[$key]['email']=$post->user->email;
					$data[$key]['phone']=$post->user->phone;
					$data[$key]['activation_date']=$post->user->activation_date;
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
				}				
			}elseif(!empty($this->request->query['rsvp'])){
				$title = 'rsvp';
				$title_row = ['Username', 'Email', 'Phone', 'Activation Date', 'Phone Verified', 'Email Verified', 'Date', 'Status'];
				$posts = $query->toArray();
				foreach($posts as $key=>$post){
					$data[$key]['username']=$post->user->username;
					$data[$key]['email']=$post->user->email;
					$data[$key]['phone']=$post->user->phone;
					$data[$key]['activation_date']=$post->activation_date;
					$data[$key]['phone_verified']=($post->is_phone_verified==1)?'Yes':'No';
					$data[$key]['email_verified']=($post->is_email_verified==1)?'Yes':'No';
					$data[$key]['date']=$post->created->format('Y-m-d H:i:s');;
					$data[$key]['active']=($post->active==1)?'Yes':'No';
				}
			}
			$this->createExcel($title, $data, $title_row);
			exit;
		}

		$companiesTable = TableRegistry::get('Companies');
		$companies = $companiesTable->find('list', ['limit' => 200]);
        $this->set(compact('companies'));
    }
	
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
		$query = $this->Users
			->find('search', $this->Users->filterParams($this->request->query));
		$query->where(['Users.id <>' => 1]);
		$query->where(['Users.group_id <>' => 3]);
		
        $this->paginate = [
            'contain' => ['Groups']
        ];

        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);
    }    
	
	/**
     * user_index method
     *
     * @return void
     */
    public function userIndex()
    {
		$query = $this->Users
			->find('search', $this->Users->filterParams($this->request->query));
		$query->where(['Users.group_id' => 3]);
		
        $this->paginate = [
            'contain' => ['Groups']
        ];

        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }    
	
	
	public function userView($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
			$validator = new Validator();
			$validator->remove('activation_key');
			$validator->remove('cds_acc_no');
			$validator->remove('company_reg_no');
			$validator->remove('phone');
            
			$user = $this->Users->patchEntity($user, $this->request->data,  ['validate' => $validator]);
			$user->role = 'admin';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
		$groups = $this->Users->Groups->find('list',['conditions'=>['id <>'=>3]]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user', 'groups']);
    }
	
	 /**
     * userAdd method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function userAdd()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
			$validator = new Validator();
			$validator->remove('activation_key');
			$validator->remove('cds_acc_no');
			$validator->remove('company_reg_no');
			$validator->remove('phone');
            
			$user = $this->Users->patchEntity($user, $this->request->data,  ['validate' => $validator]);
			$user->role = 'user';
			$user->group_id = 3;
			$user->is_super_user = 1;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
		$groups = $this->Users->Groups->find('list',['conditions'=>['id <>'=>3]]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user', 'groups']);
    }
	
	/**
     * Register method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
		$this->viewBuilder()->layout('register');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			if (!$user->errors()) {
				//get type by passcode
				$registerType = substr($this->request->data['activation_key'], 0, 2);
				if($registerType == 'AR'){
					//find the annual report
					$type = 'AnnualReport';
					$AnnreportUser = TableRegistry::get('AnnualReportUsers');
					$query = $AnnreportUser->find('all', [
						'conditions' => [
							'passcode' => $this->request->data['activation_key'],
							'account_qualifiers' => $this->request->data['account_qualifiers'],
							'cds_ac_no' => $this->request->data['cds_acc_no'],
							'icno' => $this->request->data['company_reg_no'],
							'status' => 0,
						]
					]);
					$ann_user = $query->first();
				}
				if($registerType == 'CR'){
					$type = 'Circular';
					$AnnreportUser = TableRegistry::get('CircularReportUsers');
					$query = $AnnreportUser->find('all', [
						'conditions' => [
							'passcode' => $this->request->data['activation_key'],
							'account_qualifiers' => $this->request->data['account_qualifiers'],
							'cds_ac_no' => $this->request->data['cds_acc_no'],
							'icno' => $this->request->data['company_reg_no'],
							'status' => 0,
						]
					]);
					$ann_user = $query->first();
				}
				if(!empty($ann_user)){
					//search users table for already registerd user
					$phone = $user->country_phone_no.$user->phone;
					$user_query = $this->Users->find('all', [
						'conditions' => [
							'phone' => $phone,
							'email' => $user->email
						]
					]);
					$user_record = $user_query->first();
					if(empty($user_record)){
						$user->phone = $phone;
						$user->token = mt_rand(100000, 999999);
						$user->token_expires = date('Y-m-d H:i:s',  strtotime("+15 minutes"));
						//save the user
						if ($this->Users->save($user)) {
							$userCompany = $this->Users->UserCompanies->newEntity();
							$userCompany->user_id = $user->id;
							$userCompany->related_id = $ann_user->id;
							$userCompany->type = $type;
							$userCompany->created = date('Y-m-d H:i:s');
							$userCompany->modified = date('Y-m-d H:i:s');
							$this->Users->UserCompanies->save($userCompany);
							
							$ann_user->status = 1;
							$AnnreportUser->save($ann_user);
							
							if($type !='Circular'){
								$CircularUser = TableRegistry::get('CircularReportUsers');
								$query = $CircularUser->find('all', [
									'conditions' => [
										'passcode' => $this->request->data['activation_key'],
										'account_qualifiers' => $this->request->data['account_qualifiers'],
										'cds_ac_no' => $this->request->data['cds_acc_no'],
										'icno' => $this->request->data['company_reg_no'],
										'status' => 0,
									]
								]);
								$cir_user = $query->first();
								if(!empty($cir_user)){
									$cir_user->status = 1;
									$CircularUser->save($cir_user);	
								}
							}
							$this->sendSms($user);
							$this->Flash->success(__('Your account has been created. Please verify your mobile number to proceed. Test Token='.$user->token));
							return $this->redirect(['action' => 'register-step2', $user->id]);
						}else {
							//print_r($user->errors()); exit;
							$this->Flash->error(__('The user could not be saved. Please, try again.'));
						}
					}else{
						$this->request->session()->write('report_id', $ann_user->id);
						$this->request->session()->write('report_type', $type);
						$user_record->token = md5(uniqid($user_record->id, true));
						$this->Users->save($user_record);
						$this->Flash->success(__('You already have an account. Please merge with the account and proceed.'));
						$this->request->data['already_exist'] = true;
						
						if($this->request->data['button'] == 'Proceed'){					
							return $this->redirect(['action' => 'register_login', $user_record->token]);
						}
					}
				}else{
					$this->Flash->error(__('Entered Activation Code with the details are not matched or expired. Please check and enter again to proceed.'));
				}
            }else{
				$this->Flash->error(__('The user could not be saved. Please correct the errors.'));
			}
        }
        
		$this->set(compact('user', 'country_codes'));
        $this->set('_serialize', ['user', 'country_codes']);
    }

	/**
     * Register Step 2 SMS method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function registerStep2($id)
    {
		$this->viewBuilder()->layout('register');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			if($user->token == $this->request->data['otp_password']){
				$user->is_phone_verified = 1;
				$user = $this->Users->patchEntity($user, $this->request->data);
				if ($this->Users->save($user)) {
					$user->token = md5(uniqid(rand(), true));
					$user->token_expires = date('Y-m-d H:i:s',  strtotime("+120 minutes"));
					$this->Users->save($user);
					
					$this->sendEmail($user);
					$this->Flash->success(__('Your mobile has been verified. Please verify your email to proceed.'));
					return $this->redirect('/');
				} else {
					$this->Flash->error(__('Please check the details. Try again.'));
				}
			}else{
				$this->Flash->error(__('Invalid OTP. Please enter a valid OTP.'));
			}
		}

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}

	/**
     * Verify email method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function verifyEmail($token)
    {
		$this->viewBuilder()->layout('register');
        $query = $this->Users->find('all', [
			'conditions' => ['Users.token' => $token]
		]);
		$user = $query->first();
		
		if(!empty($user)){
			$user->is_email_verified = 1;
			$user->active = 1;
			$user->group_id = 3;
			//$user->token = '';
			//$user->token_expires = '0000-00-00';
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Your account has been activated. Please set your password to login.'));
				return $this->redirect('/users/reset-password/'.$token);
			} else {
				throw new NotFoundException(__('Invalid token or link'));
			}
		}else{
			throw new NotFoundException(__('Invalid token or link'));
		}
	}
	
	
	public function forgotPassword()
    {	
	if ($this->request->is(['patch', 'post', 'put'])) {
		$email = $this->request->data['email'];
		$query = $this->Users->find('all', [
			'conditions' => ['Users.email' => $email]
		]);
		$user = $query->first();
		//print_r($user);
		if($user->email == $email){
			
			$user->token = md5(uniqid(rand(), true));
			$user->token_expires = date('Y-m-d H:i:s',  strtotime("+120 minutes"));
			$this->Users->save($user);
					
			//print_r($user);
			$url = Router::url(['controller' => 'Users','action' => 'resetPassword', $user->token, 1], true);
			$message = 'Hi '.$user->username.' <br />';
			$message .= 'Please change your password by click the following link <br />';
			$message .= '<a href="'.$url.'">Click Here</a> <br /> <br />';
			$message .= 'Thanks <br /> Gohijau';
			$email = new Email('default');
			$email->from(['info@gohijau.com' => 'GoHiju'])
			->to($user->email)
			->emailFormat('both')
			->subject('Validate Your Account - Gohiju')
			->send($message);
			$this->Flash->success(__('Please Check Your Email'));
			//$this->sendEmail($user);
		}else
		{
			 $this->Flash->error(__('Not a Valid Email'));
		}
	}
	$this->viewBuilder()->layout(false);
	$this->render('forgot_password');
	
		
	}
	public function resetPassword($token)
    {
		$this->viewBuilder()->layout(false);
        $query = $this->Users->find('all', [
			'conditions' => ['Users.token' => $token]
		]);
		$user = $query->first();
		if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
				$user->token = '';
				$user->token_expires = '0000-00-00';
				$user->active = 1;
				$user->group_id = 3;
				$user->activation_date = date('Y-m-d H:i:s');
				$this->Users->save($user);
                $this->Flash->success(__('The password has been updated. Please login to continue...'));
                return $this->redirect('/');
            } else {
                $this->Flash->error(__('The password could not be updated. Please, try again.'));
            }
        }
        $this->set('user', $user);
    }
	
	public function resetPasswordRegister($token)
    {
		$this->viewBuilder()->layout(false);
        $query = $this->Users->find('all', [
			'conditions' => ['Users.token' => $token]
		]);
		$user = $query->first();
		if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user->token = '';
			$user->token_expires = '0000-00-00';
			$user->activation_date = date('Y-m-d H:i:s');
            if ($this->Users->save($user)) {
				$userCompany =  $this->Users->UserCompanies->newEntity();
				$userCompany->user_id = $user->id;
				$userCompany->related_id = $this->request->session()->read('report_id');
				$userCompany->type = $this->request->session()->read('report_type');
				$this->Users->UserCompanies->save($userCompany);
				
				$AnnreportUser = TableRegistry::get('AnnualReportUsers');
				$query = $AnnreportUser->find('all', [
					'conditions' => [
						'id' => $userCompany->related_id
					]
				]);
				$ann_user = $query->first();
				$ann_user->status = 1;
				$AnnreportUser->save($ann_user);				
				
                $this->Flash->success(__('The password has been updated. Please login to continue'));
                return $this->redirect('/');
            } else {
                $this->Flash->error(__('The password could not be updated. Please, try again.'));
            }
        }
        $this->set('user', $user);
		$this->render('reset_password');
    }
	
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
		$groups = $this->Users->Groups->find('list',['conditions'=>['id <>'=>3]]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user', 'groups']);
    }
	    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function userEdit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'user-index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
		$groups = $this->Users->Groups->find('list',['conditions'=>['id <>'=>3]]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user', 'groups']);
    }
	
	/**
     * Profile method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function profile($id = null)
    {
		$id= $this->Auth->user('id');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user profile has been saved.'));
                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('The user profile could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	/**
	* sendEmail
	*/
	
	private function sendEmail($user){
		//generate url
		$url = Router::url(['controller' => 'Users','action' => 'verify-email', $user->token], true);
		
		$message = 'Hi '.$user->username.' <br />';
		$message .= 'Please validate your email by click the follwing link <br />';
		$message .= '<a href="'.$url.'">Click Here</a> <br /> <br />';
		$message .= 'Thanks <br /> gohijau';
		//Email::deliver($user->email, 'Validate Your Account', $message, ['from' => 'info@gohiju.com']);
			
		$email = new Email('default');
		return $email->from(['info@gohijau.com' => 'GoHiju'])
			->to($user->email)
			->emailFormat('both')
			->subject('Validate Your Account - Gohiju')
			->send($message);
	}
	/**
	* SendSMS
	*/
	
	private function sendSms($user){
		$sid = "ACef7ae7f3da8075d696d8c9fdb2b00259";
		$token = "eb50d4935fece62655da4f407baecb5d";

		$client = new \Services_Twilio($sid, $token);
		$message = $client->account->messages->sendMessage(
			'+14243431198', // From a valid Twilio number
			$user->phone, // Text this number
			"Hello ".$user->username.". Welcome to Gohiju. Passcode: ".$user->token
		);
		return $message;
	}
	
    function build_table($array){
		// start table
		$html = '<table border="1" cellspacing="1">';
		// header row
		$html .= '<tr>';
		foreach($array[0] as $key=>$value){
				$html .= '<th>' . Inflector::humanize($key) . '</th>';
			}
		$html .= '</tr>';

		// data rows
		foreach( $array as $key=>$value){
			$html .= '<tr>';
			foreach($value as $key2=>$value2){
				$html .= '<td>' . $value2 . '</td>';
			}
			$html .= '</tr>';
		}

		// finish table and return it

		$html .= '</table>';
		return $html;
	}
	
	private function createPdf($title, $data){
		// create new PDF document
		$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetAuthor('Gohijau');
		$pdf->SetTitle('Gohijau');
		$pdf->SetSubject('Gohijau');
		$pdf->SetKeywords('Gohijau');
		$header_logo = 'logo.png';
		// set default header data
		$pdf->SetHeaderData($header_logo, PDF_HEADER_LOGO_WIDTH, $title, 'Gohiju.com', array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		$pdf->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		$pdf->AddPage(); 

		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		$tbl = $this->build_table($data);
		$pdf->writeHTML($tbl, true, false, false, false, '');
		$pdf->Output($title.'.pdf', 'D');
	}
	
	
	private function createExcel($title, $data = [], $titleRow=[]){
		$doc = new \PHPExcel();
		$doc->setActiveSheetIndex(0);
		$doc->getActiveSheet()->fromArray($titleRow, null, 'A1');
		$doc->getActiveSheet()->fromArray($data, null, 'A2');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$title.'.xls"');
		header('Cache-Control: max-age=0');

		// Do your stuff here
		$writer = \PHPExcel_IOFactory::createWriter($doc, 'Excel5');
		$writer->save('php://output');		
		exit;
	}
}
