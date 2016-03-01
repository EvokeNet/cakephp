<?php

App::uses('Component','Controller','Utility');

class PermissionComponent extends Component {

	public $components = array('Session');

    public $scores = array();


    public function startup(Controller $controller) {
        
        $scores = $this->scores();

        $this->Controller = $controller;
    }

    public function scores(){
        if(isset($scores)){
            return $scores;
        }else{
           $role_class = ClassRegistry::init('Role');

            $scores = array(
                'ADMIN'=> $role_class->find('first',array('conditions' => array('name' => 'ADMIN')))['Role']['score'],
                'USER' => $role_class->find('first',array('conditions' => array('name' => 'USER')))['Role']['score']
            );

           return $scores;
        }
        
    }

    public function scores_id(){
        if(isset($scores)){
            return $scores;
        }else{
           $role_class = ClassRegistry::init('Role');

            $scores = array(
                'ADMIN'=> $role_class->find('first',array('conditions' => array('name' => 'ADMIN')))['Role']['id'],
                'USER' => $role_class->find('first',array('conditions' => array('name' => 'USER')))['Role']['id']
            );

           return $scores;
        }
        
    }

    public function role() {
        $role_class = ClassRegistry::init('Role');

        if ($this->role == null) {
            $roleid = $this->Session->read('Auth.User.role_id');
            $role = $role_class->find('first', array('conditions' => array('id' => $roleid)))['Role']['score'];
            if (isset($role)) {
                $this->role = $role;
            }
        }
        return $this->role;
    }

/**
 *  hasPrivilege
 *  Checks if user has privilege
 *  @param array $options
 *      minimumRole - score - mininum role expected
 *      object - string - optional - page's controller name that the user tries to access
 *      moderatorPrivilege - bool - optional - true if higher privilege user can access a lower privilege user's private content
 *  @return bool Access
 */
    public function hasPrivilege($options){

        $role = $this->role();
        $scores = $this->scores();

        if(isset($options['minimumRole'])){
            $minimumRole = $scores[$options['minimumRole']];
        }else{
            return false;
        }

        if(isset($options['moderatorPrivilege'])){
            $moderatorPrivilege = $options['moderatorPrivilege'];
        }

        if(isset( $options['object'])){
            $object = $options['object'];
        }

        //CHECKS IF USER HAS MININUM ROLE
        if($role <= $minimumRole){

            if(isset($moderatorPrivilege)){
                if($moderatorPrivilege){
                    //CHECKS IF USER HAS MODERATOR PRIVILEGE
                    if($role < $minimumRole){
                        return true;
                    }
                }
            }

            if(isset($object)){
                return $this->userHasObjectPrivilege($object);
            }

            return true;
        }

        return false;
    }


    //CHECKS IF USER HAS PRIVILEGE IN A SPECIFIC PAGE
    public function userHasObjectPrivilege($object) {

		$class = ClassRegistry::init($object['class']);

       	$owner = $class->field('user_id', array('id' => $object['id']));
       	$user = $this->Session->read('Auth.User.id');

       	//CHECK IF USER IS OBJECT'S OWNER
		if($user == $owner){
            return true;
        }

        return false;
    }

    public function hasRole($role) {
        return $this->scores[$this->role()] <= $this->scores[$role];
    }
}
