<head>
</head>

<!-- <table style = "background-color: #283954; padding:20px; border-spacing: 0px;"> -->
<table style = "background-color: #363636;
  padding:20px;
  border: 20px solid #000000;
  margin: 20px 0px 50px 0px;
  -webkit-box-shadow: 2px 3px 2px 0px rgba(137,87,102,1);
  -moz-box-shadow: 2px 3px 2px 0px rgba(137,87,102,1);
  box-shadow: 2px 3px 2px 0px rgba(137,87,102,1);">

  <h1 style = "font-size:2.0em; color:#fff; font-weight:bold"><?php echo sprintf(__('Hi %s', $recipient['User']['name']));?></h1>
  <h2 style = "font-size:1.5em; color:#fff; font-weight:bold"><?php echo sprintf(__('You have one invite request for your group %s'), $group['Group']['title']);?></h2>

  <div style = "background-color:#fff; min-height: 150px; padding: 20px; border-radius: 10px; border: 2px solid #000; ">
    <div style = "position:relative; float:left">
        <?php if($sender['User']['photo_attachment'] == null) : ?>
            <?php if($sender['User']['facebook_id'] == null) : ?>
                <img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/>
            <?php else : ?> 
                <img src = "https://graph.facebook.com/<?php echo $sender['User']['facebook_id']; ?>/picture?type=large">
            <?php endif; ?>
            
        <?php else : ?>
            <img src="<?= $this->webroot.'files/attachment/attachment/'.$sender['User']['photo_dir'].'/'.$sender['User']['photo_attachment'] ?>" />
        <?php endif; ?>
    </div>
    <div style = "margin-left: 160px;">
      <ul style = "list-style:none">
        <li><?php echo $sender['User']['name'];?></li>
        <li><?php echo $sender['User']['email'];?></li>
        <li><?php echo $sender['User']['birthdate'];?></li>
        <li><?php echo $sender['User']['biography'];?></li>
      </ul>
    </div>
  </div>

  <button class = "general" style = "
      margin: 50px 0px 30px 0px; background: #ba5660;
      color: #ffffff;
      font-size: 0.9em;
      border-radius: 5px;
      padding: 0.4em 2em;
      margin-right: 10px;
      border-right: 3px solid #87363b;
      border-bottom: 3px solid #87363b;">
      <a href="<?php echo $_SERVER['SERVER_NAME'].'/evoke/groupsUsers/add/?arg='.$sender['User']['id'].'&arg2='.$group['Group']['id']; ?>" style = "color: #fff; text-decoration: none;"><?php echo __('Accept User');?></a>
  </button>

  <button class = "general" style = "margin: 50px 0px 30px 0px; background: #ba5660;
      color: #ffffff;
      font-size: 0.9em;
      border-radius: 5px;
      padding: 0.4em 2em;
      margin-right: 10px;
      border-right: 3px solid #87363b;
      border-bottom: 3px solid #87363b;">
      <a href="<?php echo $_SERVER['SERVER_NAME'].'/evoke/groupRequests/decline/?arg='.$sender['User']['id'].'&arg2='.$group['Group']['id']; ?>" style = "color: #fff; text-decoration: none;"><?php echo __('Decline User');?></a>
  </button>
</table>