<h1><?php echo sprintf(__('Agent %s sent a request to join your group %s', $sender['User']['name'], $group['Group']['title']));?></h1>
<h2><?php echo __("Agent's Dossier");?></h2>

<table>
  <tbody>
    <tr>
    	<td><img src="https://graph.facebook.com/<?php echo $sender['User']['facebook_id']; ?>/picture?type=large"/></td>   	
      	<td>
	      <ul style = "list-style:none">
			  <li><?php echo $sender['User']['name'];?></li>
			  <li><?php echo $sender['User']['email'];?></li>
			  <li><?php echo $sender['User']['birthdate'];?></li>
			  <li><?php echo $sender['User']['biography'];?></li>
			</ul>
		</td>
    </tr>
    <tr>
      <td><button style = "margin: 50px 0px 30px 0px"><a href="<?php echo $_SERVER['SERVER_NAME'].'/evoke/groupsUsers/add/?arg='.$sender['User']['id'].'&arg2='.$group['Group']['id']; ?>"><?php echo __('Add User');?></a></button></td>
    </tr>
  </tbody>
</table>