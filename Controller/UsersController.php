<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

    public $helpers = [
        'Html' => [
            'className' => 'Bootstrap3.BootstrapHtml'
        ],
        'Form' => [
            'className' => 'Bootstrap3.BootstrapForm'
        ],
        'Paginator' => [
            'className' => 'Bootstrap3.BootstrapPaginator'
        ],
        'Modal' => [
            'className' => 'Bootstrap3.BootstrapModal'
        ]
    ];
     
    public function initialize()
    {
        $this->loadComponent('Auth');
        $this->loadComponent('Flash');
    }

	protected $secureActions = array('login');

	public function beforeFilter(\Cake\Event\Event $event) 
	{
		parent::beforeFilter($event);
		if ( in_array($this->params['action'], $this->secureActions) && !isset($_SERVER['HTTPS']) )
		{
			$this->forceSSL();
		}
		$this->Auth->allow(['register', 'login', 'recover', 'setNewPassword']);
	}

    public function login ()
	{
        $this->set('noNavbar',True);
        $this->set('user', $this->Users->newEntity());
		if( $this->request->is('post') )
		{
			if ($this->request->is('post')) {
                $user = $this->Auth->identify();
		        if ($user) {
                    $this->Auth->setUser($user);
		            return $this->redirect($this->Auth->redirectURL());
		        }
                else
                {
                    debug($user);
		            $this->Flash->error(__('Invalid username or password, try again'));
                }
		    }
		}
	}
	
	public function register() 
	{
        $this->set('noNavbar', True);
        $user = $this->Users->newEntity();
		if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->set(__('The user has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->set(
                __('The user could not be saved. Please, try again.')
            );
        }
        $this->set('user',$user);
	}

	public function recover()
	{
        $this->set('noNavbar', True);
		if($this->request->is('post'))
		{
			$data = $this->Users->find('all', [
					'conditions' => [
						'Users.email' => $this->request->data["email"]
					]
				]
			);
			if($data->count() == 0)
			{
				$this->Flash->set('Keine solche E-Mail Adresse registriert.');
			}
			else
			{
                $user = $data->first();
				$key = $user->resetkey;
				$id = $user->id;
				$mail = $user->email;
				$email = new Email('default');
				$email->to($mail);
				$email->emailFormat('html');
				$email->subject(__('Anleitung zum Passwort neusetzen'));
				$email->viewVars(array('key'=>$key,'id'=>$id,'rand'=> mt_rand()));
				$email->template('recover_password');
				if( $email->send('recover_password') )
				{
					$this->Flash->set('Instruktionen wurden Ihnen per E-Mail zugeschickt!');
				}
				else
				{
					$this->Flash->set('Etwas ist schief gelaufen. Bitte probieren Sie es später erneut.');
				}

			}
		}
	}

	public function setNewPassword()
	{
        $this->set('noNavbar', True);
		if($this->request->is('post'))
		{
			$data = $this->Users->find('all', array
				(
					'conditions' => array
					(
						'Users.id' => $this->request->data['User']['id'],
						'Users.resetkey' => $this->request->data['User']['resetkey']
					)
				)
			);
            $data = $data->first();
			if( !$data )
			{
				$this->Flash->set(__('Benutzer nicht gefunden oder Key inkorrekt!'));
			}
			else
			{
                $usersTable = TableRegistry::get('Users');
                $data->password = $this->request->data['User']['password'];
				if ( $usersTable->save($data) )
                {
                	$this->Flash->set(__('New Password saved!'));
                	return $this->redirect(array('action' => 'login'));
	            }
	            	$this->Flash->set(debug($this->request->data));
				}
		}
		else
		{
			$a = func_get_args();
			$keyPair = $a[0];
			$key = explode('BXX', $keyPair);
			$pair = explode('XXB',$key[1]);
			$resetkey = $key[0];
			$id = $pair[1];
			$data = $this->Users->find('all', array
				(
					'conditions' => array
					(
						'Users.id' => $id,
						'Users.resetkey' => $resetkey
					)
				)
			);
            $data = $data->first();
			if( !$data )
			{
				$this->Flash->set('Benutzer nicht gefunden oder Key inkorrekt!');
			}
			else
			{
				$this->set('id', $data->id);
				$this->set('resetkey', $data->resetkey);
				$this->set('username', $data->username);
			}
		}
	}

    public function edit($id = null)
    {
        if( $id == null )
        {
            $id = $this->Auth->user('id');
        }
        $data = $this->User->find('first', array
            (
                'conditions' => array
                (
                    'User.id' => $id,
                )
            )
        );
        $this->set('id',$id);
        $this->set('email',$data['User']['email']);
        if( $this->request->is('post') )
        {
            $options = array(
                'fieldList' => array(
                    'email',
                    'password',
                    'password_confirm'
                )
            );
            if( $this->User->save($this->request->data,$options) )
            {
                $this->Flash->set(__('0/Changes saved!'),'flash_minimal');
            }
            else
            {
                $this->Flash->set(__('2/Error while saving!'));
                debug($this->User->validationErrors);
            }
        }
    }

	public function logout ()
	{
		return $this->redirect($this->Auth->logout());
	}

	private function forceSSL ()
	{
		return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
	}
}

?>
