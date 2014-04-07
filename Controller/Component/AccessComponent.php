<?php 
class AccessComponent extends Component{ 
    var $components = array('Acl', 'Auth'); 
    
    function startup(Controller $controller){ 
    } 

/*
* check method
* checks if the user's role - set by default as a normal user (3) - has 
* permission to access the requested aco and action
*/
    function check($user_role = 3, $aco, $action='*'){ 
	    if($this->Acl->check(array(
	    	'model' => 'Role', 
	    	'foreign_key' => $user_role
	    ), $aco, $action)) { 
	        return true; 
	    } else { 
	        return false; 
	    } 
	}
} 
