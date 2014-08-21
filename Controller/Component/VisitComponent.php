<?php 

class VisitComponent extends Component{ 
    
    function countVisitor($user_id, $user_ip, $date){ 
	    $redis = new Redis() or die("Cannot load Redis module.");
		$redis->connect('127.0.0.1');

		$redis->incr($date.':visitors');
		$redis->sadd($date.':uniqueVisitors', $user_ip);
		$redis->sadd($date.':uniqueVisitorsID', $user_id);
	}
} 