<?php

class UsersController extends AppController
{

	public $helpers = array('Html');
	public $components = array(
		'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        )
    );
	protected $secureActions = array('login');

	public function beforeFilter() 
	{
		parent::beforeFilter();
		if ( in_array($this->params['action'], $this->secureActions) && !isset($_SERVER['HTTPS']) )
		{
			$this->forceSSL();
		}
		App::uses('CakeEmail', 'Network/Email');
		$this->Auth->allow('register', 'login', 'recover', 'setNewPassword');
	}

    public function login ()
	{
		if( $this->request->is('post') )
		{
			if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		            return $this->redirect($this->Auth->redirect());
		        }
		        $this->Session->setFlash(__('Invalid username or password, try again'));
		    }
		}
	}
	
	public function register() 
	{
		if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
	}

	public function recover()
	{
		if($this->request->is('post'))
		{
			$data = $this->User->find('first', array
				(
					'conditions' => array
					(
						'User.email' => $this->request->data["email"]
					)
				)
			);
			if(!$data)
			{
				$this->Session->setFlash('Keine solche E-Mail Adresse registriert.');
			}
			else
			{
				$key = $data['User']['resetkey'];
				$id = $data['User']['id'];
				$mail = $data['User']['email'];
				$email = new CakeEmail('smtp');
				$email->to($mail);
				$email->emailFormat('html');
				$email->subject(__('Anleitung zum Passwort neusetzen'));
				$email->viewVars(array('key'=>$key,'id'=>$id,'rand'=> mt_rand()));
				$email->template('recover_password');
				if( $email->send('recover_password') )
				{
					$this->Session->setFlash('Instruktionen wurden Ihnen per E-Mail zugeschickt!');
				}
				else
				{
					$this->Session->setFlash('Etwas ist schief gelaufen. Bitte probieren Sie es später erneut.');
				}

			}
		}
	}

	public function setNewPassword()
	{
		if($this->request->is('post'))
		{
			$data = $this->User->find('first', array
				(
					'conditions' => array
					(
						'User.id' => $this->request->data['User']['id'],
						'User.resetkey' => $this->request->data['User']['resetkey']
					)
				)
			);
			if( !$data )
			{
				$this->Session->setFlash('Benutzer nicht gefunden oder Key inkorrekt!');
			}
			else
			{
				if ( $this->User->saveField('password', $this->request->data['User']['password']) ) {
                	$this->Session->setFlash(__('Neues Passwort gespeichert!'));
                	return $this->redirect(array('action' => 'login'));
	            }
	            	$this->Session->setFlash(debug($this->request->data));
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
			$data = $this->User->find('first', array
				(
					'conditions' => array
					(
						'User.id' => $id,
						'User.resetkey' => $resetkey
					)
				)
			);
			if( !$data )
			{
				$this->Session->setFlash('Benutzer nicht gefunden oder Key inkorrekt!');
			}
			else
			{
				$this->set('id', $data['User']['id']);
				$this->set('resetkey', $data['User']['resetkey']);
				$this->set('username', $data['User']['username']);
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
