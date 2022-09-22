<?php


App::uses('AppController', 'Controller');

class HomeController extends AppController {

	public $uses = array('User');

	public function index() {
		
	}

	public function profile() {

		if($this->request->isAjax()) {

			$this->layout = null;

			$this->autoRender = false;

			if($this->request->is('post')) {

				$id = $this->Auth->user()[0]['User']['id'];

				$user = $this->User->find('first', array(

					'conditions' => array('User.id' => $id)
				));

				if(!empty($user)) {

					return json_encode(array($user['User']));
				}
			}
		}
	}

	public function editProfile() {

		if($this->request->isAjax()) {

			if($this->request->is('post')) {

				$this->layout = null;

				$this->autoRender = false;

				$data = $this->Auth->user();

				$id = $data[0]['User']['id'];

				$query = $this->User->read(null, $id);

				$profile = $this->request->data;

				// // image upload
				$filename = "";
				$name = $this->request->params['form']['image']['name'];
				$tmp_name = $this->request->params['form']['image']['tmp_name'];

				if(!empty($name)) {

			        $filename = $name;
			        move_uploaded_file($tmp_name, WWW_ROOT . 'img/' . $name);

				} else {

					$filename = $query['User']['image'];
				}

				$this->User->set(array(
					'image' => $filename,
					'name' => $profile['name'], 
					'email' => $profile['email'], 
					'phone' => $profile['phone'],
					'modified' => date("Y-m-d H:i:s"),
					'modified_ip' => $this->request->clientIp()
				));  

				if($this->User->save()) {

					return json_encode(array('success' => 1, 'message' => 'Successfully updated'));
				}

				// print_r($this->request->params['form']['image']['name']);        
			}
		}
	}

	public function getRecipients() {

		if($this->request->isAjax()) {

			if($this->request->is('post')) {

				$this->layout = null;

				$this->autoRender = false;

				$id = $this->Auth->user()[0]['User']['id'];

				$recipients = $this->User->find('all', array(
					'fields' => array('User.id', 'User.image', 'User.name'),
					'conditions' => array('NOT' => array('User.id' => array($id)))
				));

				$option = "<select id='recipient' name='recipient' style='width: 50%'><option value='' selected hidden>Choose Recipient</option>
				";

				foreach($recipients as $recipient) {

					$image = ($recipient['User']['image']!="") ? $recipient['User']['image'] : 'user_none.png';

					$option .= '<option value='.$recipient['User']['id'].' data-thumb='.$image.'>'.$recipient['User']['name'].'</option>';
				}

				$option .= '</select>';

				return json_encode(array('success' => 1, 'recipients' => $option));
			}
		}
	}
}