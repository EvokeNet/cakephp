<?php

App::uses('Component', 'Controller');

class UserRoleComponent extends Component {

    public $components = array('Session');

    private $role = null;
    private $score = array(
        'user' => 0,
        'manager' => 1,
        'admin' => 2
    );

    public function role() {
        if ($this->role == null) {
            $this->role = strtolower($this->Session->read('Auth.User.role')) ?: 'user';
        }
        return $this->role;
    }

    public function is($role) {
        // debug($this->score[$this->role()].' user');
        // debug($this->score[$role].' admin');
        // debug($this->score[$this->role()] >= $this->score[$role]);
        return $this->score[$this->role()] >= $this->score[$role];
    }

}
