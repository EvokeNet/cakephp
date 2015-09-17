<?php 

class VisitComponent extends Component{ 
    
    function countVisitor($user_id, $user_ip, $date){ 
	    $redis = new Redis() or die("Cannot load Redis module.");
		$redis->connect('127.0.0.1');

		$today = date('Y:m:d', $date);
		$monthly = date('F:Y', $date);

		$redis->incr($today.':visitors');
		$redis->sadd($today.':uniqueVisitors', $user_ip);
		$redis->sadd($today.':uniqueVisitorsID', $user_id);

		$redis->incr($monthly.':visitors');
		$redis->sadd($monthly.':uniqueVisitors', $user_ip);
		$redis->sadd($monthly.':uniqueVisitorsID', $user_id);
	}
} 