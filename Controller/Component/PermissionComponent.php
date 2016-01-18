<?php 

App::uses('Component','Controller','Utility');

class PermissionComponent extends Component {

	public $components = array('Session');

    public $scores = array(
        ADMIN   => 0,
        USER    => 10
    );
    

    public function startup(Controller $controller) {
      $this->Controller = $controller;
    }

    public function role() {
        if ($this->role == null) {
            $role = $this->Session->read('Auth.User.role');
            if (isset($role)) {
                $this->role = $role;
            }
        }
        return $this->role;
    }

    public function hasPrivilege($id, $object){

        $role = $this->Session->read('Auth.User.role');

        if($role == ADMIN) return true;

        if($role == USER) {

            if(isset($object)){
                return $this->userHasObjectPrivilege($id, $object);
            }
        }
        
        return false;
    }

    public function userHasObjectPrivilege($id, $object) {

		$object = ClassRegistry::init($object);

       	$owner = $object->field('user_id', array('id' => $id));
       	$user = $this->Session->read('Auth.User.id');

       	//CHECK IF USER IS OBJECT'S OWNER
		if($user == $owner) return true;

        return false;
    }

    public function hasRole($role) {
        return $this->scores[$this->role()] <= $this->scores[$role];
    }
}