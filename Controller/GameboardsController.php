<?php
App::uses('AppController', 'Controller');
/**
 * Gameboards Controller
 *
 * @property Gameboard $Gameboard
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GameboardsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


/**
 * gameboard method
 *
 * @return void
 */
  public function index() {
    $this->loadModel('GameboardPlayer');

    $gameboard = $this->GameboardPlayer->find('first', array(
        'conditions' => array(
          'user_id' => AuthComponent::user('id')
        ),
    ));

    if(isset($gameboard) && !empty($gameboard)){
      $this->set('id',$gameboard['GameboardPlayer']['gameboard_id']);
    }else{
      debug("teste");
    }
  }


/**
 * gameboard json method
 *
 * @return void
 */
  public function gameboard_layout() {
    $this->autoRender = false;

    $regions = array(
      'opression',
      'conflict',
      'apathy',
      'misunderstanding'
    );

    $gameboard = $this->create_gameboard(48, $regions, 4);

    return json_encode($gameboard);
  }  


  public function lastInsertedGameboardId(){
  	$gameboard = $gameboardId = $this->Gameboard->find('first', array(
	      'order' => array(
	        'Gameboard.id DESC'
	      ),
	    ));

  	if(isset($gameboard) && !empty($gameboard)){
  		return $gameboard['Gameboard']['id'];
  	}
  	return -1;
  }

  public function gameboard_layout_id($id){
    $this->autoRender = false;

    if(!$this->Gameboard->exists($id)){
      return "Invalid id";
    }

    $gameboard = array(
        'nodes' => $this->select_nodes($id),
        'edges' => $this->select_edges($id)
    );

    return json_encode($gameboard);
  }


  public function select_nodes($gameboard_id){
    $this->loadModel('GameboardNode');

    $nodes = $this->GameboardNode->find('all', array(
        'fields' => array(
          'GameboardNode.*',
          'Mission.id',
          'Mission.title',
          'Mission.description'
        ),
        'joins' => array(
          array(
            'table' => 'missions',
            'alias' => 'Mission',
            'type' => 'LEFT',
            'conditions' => array(
              'GameboardNode.mission_id = Mission.id'
            ),
          ),
        ),
        'conditions' => array(
          'gameboard_id' => $gameboard_id
        ),
    ));

    $gameboard_nodes = array();

    foreach($nodes as $node){
      array_push($gameboard_nodes, $this->select_node($node));
    }

    return $gameboard_nodes;
  }

  public function select_edges($gameboard_id){
    $this->loadModel('GameboardEdge');

    $edges = $this->GameboardEdge->find('all', array(
        'conditions' => array(
          'gameboard_id' => $gameboard_id
        ),
    ));

    $gameboard_edges = array();

    foreach($edges as $edge){
      array_push($gameboard_edges, $this->select_edge($edge));
    }

    return $gameboard_edges;
  }  

  public function select_node($node){
    return array(
      'id' => (int) $node['GameboardNode']['position'],
      'caption' => (int) $node['GameboardNode']['problem_points'],
      'role' => $node['GameboardNode']['role'],
      'root' => $node['GameboardNode']['root'], 
      'problem_points' => (int) $node['GameboardNode']['problem_points'], 
      "severity_counter" => (int) $node['GameboardNode']['severity_counter'],
      'mission_id' => (int) $node['Mission']['id'],
      'mission_title' => $node['Mission']['title'],
      'mission_description' => $node['Mission']['description']
    );
  }

  public function select_edge($edge){
    return array(
      'source' => (int) $edge['GameboardEdge']['source'],
      'target' => (int) $edge['GameboardEdge']['target']
    );
  }


 /**
 * 
 * GAMEBOARD
 *
 * @return gameboard
 */
  public function create_gameboard($size, $regions, $levels){

  	  $this->loadModel('Gameboard');

  	  $gameboardId = $this->lastInsertedGameboardId();
  	  $gameboardId = $gameboardId != -1 ? $gameboardId + 1 : 1;

  	  $gameboard = array('Gameboard' => array('id' => $gameboardId));

  	  $this->Gameboard->create();
	    $this->Gameboard->save($gameboard);

	    $gameboard_id = $this->lastInsertedGameboardId();

      $nodes = array($this->create_node(0, '', true, 0, $gameboard_id,0));
      $edges = array();
      $region_size =  $size / sizeof($regions);
      $level_size = $region_size / $levels;
      $missions = $this->allMissions();
      $count = 0;

      $problem_points = array(3,3,3,2,2,2,1,1,1);

      for($x = sizeof($problem_points); $x < $size; $x++){
        array_push($problem_points, 0);
      }

      shuffle($problem_points);

      foreach($regions as $region){

        for($x = 0; $x < $region_size; $x++){
          $count++;
          $root = false;
          $mission = $count % sizeof($missions);
          $mission_id = $missions[$mission]['Mission']['id'];
          array_push($nodes,$this->create_node($count, $region, $root, $problem_points[$count-1], $gameboard_id, $mission_id));

          // connect to root
          if($x < $level_size){
            array_push($edges,$this->create_edge(0, $count, $gameboard_id));
          }else{
            // connect to lower level node
            array_push($edges,$this->create_edge($count - $level_size, $count, $gameboard_id));
          }

          // connect to level nodes
          if($level_size > 1 && $x % $level_size > 0){
            array_push($edges,$this->create_edge($count-1, $count, $gameboard_id));
          }

          // connect to another region
          if(sizeof($regions) > 1){

            // if first node
            if($x % $level_size == 0){

              $dist = $region_size - $level_size + 1;

              $source_node = $count <= $dist ? $count - $dist + $size : $count - $dist;

              array_push($edges,$this->create_edge($source_node, $count, $gameboard_id));
            }

          }


        }
      }

      $gameboard = array(
        'nodes' => $nodes,
        'edges' => $edges
      );

      return $gameboard;
  }


  public function allMissions(){
    $this->loadModel('Mission');
    $missions = $this->Mission->find('all');
    return $missions;
  }


/**
 * 
 * GAMEBOARD
 *
 * @return edge
 */
  public function create_edge($source, $target, $gameboard_id) {
    $this->loadModel('GameboardEdge');

    $gameboardEdge = array('GameboardEdge' => 
      array(
        'gameboard_id' => $gameboard_id, 
        'source' => $source,
        'target' => $target
      )
    );

   $this->GameboardEdge->create();
   $this->GameboardEdge->save($gameboardEdge); 

   return array('source' => $source,'target' => $target);
  }  


  public function create_node($id, $role, $root, $points, $gameboard_id, $mission_id) {
  	$default_severity_counter = 2;

  	$this->loadModel('GameboardNode');

  	$gameboardNode = array('GameboardNode' => 
  		array(
  			'gameboard_id' => $gameboard_id, 
  			'mission_id' => $mission_id,
  			'position' => $id,
  			'role' => $role,
  			'root' => $root, 
  			'problem_points' => $points,
  			'severity_counter' => $default_severity_counter
  		)
  	);

  $this->GameboardNode->create();
	$this->GameboardNode->save($gameboardNode);	

	return array('id' => $id,'caption' => $points, 'role' => $role, 'root' => $root, 'problem_points' => $points, "severity_counter" => $default_severity_counter);
  }   

}
