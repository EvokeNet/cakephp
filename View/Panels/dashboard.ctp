<?php

	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new'
		)
	);

?>

<div class="sticky">
	<nav class="top-bar" data-topbar data-options="sticky_on: large">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="#">My Site</a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
	      <li class="active"><a href="#">Right Button Active</a></li>
	      <li class="has-dropdown">
	        <a href="#">Right Button Dropdown</a>
	        <ul class="dropdown">
	          <li><a href="#">First link in dropdown</a></li>
	        </ul>
	      </li>
	    </ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul>
	  </section>
	</nav>
</div>

<div class="row row-full-width">
  <div class="large-2 columns padding-left-0">
	  <div class = "menu-column">
	  </div>
  </div>
  <div class="large-10 columns">

	<ul class="small-block-grid-3 padding-top-2">
	  
	  <li>
	  	<input type="search" class="light-table-filter" data-table="order-table-missions" placeholder="<?= __('Search missions') ?>">
		<table class="order-table-missions paginated" id = "missionsTable">
			<thead>
				<tr>
					<th width="25"><input type="checkbox" onclick="checkAll('missionsTable', 'mis')" name="chk[]" id="mis" /></th>
					<th><?= _('Missions') ?></th>
		      		<th width="25"></th>
		      		<th width="25"><a href="#" data-reveal-id="myModalAddOrg"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new organization -->
				</tr>
			</thead>
			<tbody>
				<?php foreach($missions as $m): ?>
				<tr>
				  <td><input type="checkbox" name="chkbox[]"></td>
			      <td><?= $m['Mission']['title'] ?></td>
			      <td><a href="<?php echo $this->Html->url(array('controller'=>'panels', 'action' => 'edit_mission', $m['Mission']['id'])); ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
			      <td><a href="<?php echo $this->Html->url(array('controller'=>'missions', 'action' => 'delete', $m['Mission']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
			    </tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
	  </li>

	  <li>
		<input type="search" class="light-table-filter" data-table="order-table-badges" placeholder="<?= __('Search badges') ?>">
		<table class="order-table-badges paginated" id = "badgeTable">
			<thead>
				<tr>
					<th width="25"><input type="checkbox" onclick="checkAll('badgeTable', 'bdg')" name="chk[]" id="bdg" /></th>
					<th><?= _('Badges') ?></th>
		      		<th width="25"></th>
		      		<th width="25"><a href="#" data-reveal-id="myModalAddBadge"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new organization -->
				</tr>
			</thead>
			<tbody>
				<?php foreach($badges as $m): ?>
		  		<tr>
		  		  <td><input type="checkbox" name="chkbox[]"></td>
			      <td><?= $m['Badge']['name'] ?></td>
			      <td><a href="#" data-reveal-id="myModalEditBadge<?= $m['Badge']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
			      <td><a href="<?php echo $this->Html->url(array('controller'=>'badges', 'action' => 'delete', $m['Badge']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
			    </tr>

			    <!-- Add new notification form -->
				<div id="myModalEditBadge<?= $m['Badge']['id'] ?>" class="reveal-modal tiny" data-reveal>
			  		<?php 
						echo $this->Form->create('Badge', array(
					 		'url' => array(
					 			'controller' => 'badges',
					 			'action' => 'edit', 
					 			$m['Badge']['id']
					 		)
						));

						echo $this->Form->input('name', array(
							'label' => __('Name'),
							'required' => true,
							'value' => $m['Badge']['name']
						));
						
						echo $this->Form->input('description', array(
							'label' => __('Description'),
							'type' => 'textarea',
							'required' => true,
							'value' => $m['Badge']['description']
						));

						echo '<fieldset><legend> ' .__('Necessary Power Points to get Badge') . '</legend>';
				        foreach ($powerpoints as $power) {
				            $previous = 0;
				            foreach ($mypp as $pp) {
				                if($pp['BadgePowerPoint']['power_points_id'] == $power['PowerPoint']['id'] && $pp['BadgePowerPoint']['badge_id'] == $m['Badge']['id'])
				                    $previous = $pp['BadgePowerPoint']['quantity'];
				            }
				            echo $this->Form->input('Power.' . $power['PowerPoint']['id'] . '.quantity', array(
				                'label' => $power['PowerPoint']['name'],
				                'value' => $previous
				            ));
				        }
				        echo '</fieldset>';

					?>
					<button class="button tiny" type="submit">
						<?php echo __('Save Changes')?>
					</button>
					<?php echo $this->Form->end(); ?>

				  <a class="close-reveal-modal">&#215;</a>
				</div>

			    <?php endforeach; ?>
			</tbody>
		</table>

		<!-- Add new notification form -->
		<div id="myModalAddBadge" class="reveal-modal tiny" data-reveal>
	  		<?php 
				echo $this->Form->create('Badge', array(
			 		'url' => array(
			 			'controller' => 'badges',
			 			'action' => 'panel_add'
			 		)
				));

				echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
				echo $this->Form->input('name_es', array('label' => __('Spanish Name')));
				echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
				echo $this->Form->input('description_es', array('label' => __('Spanish Description')));
				echo '<div class="input file"><label for="Attachment0Attachment">Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';

				echo '<fieldset><legend> ' .__('Necessary Power Points to get Badge') . '</legend>';
		        foreach ($powerpoints as $power) {
		            echo $this->Form->input('Power.' . $power['PowerPoint']['id'] . '.quantity', array(
		                'label' => $power['PowerPoint']['name'],
		                'value' => 0
		            ));
		        }
		        echo $this->Form->input('Power.0.quantity', array(
		                'label' => 'No specific power',
		                'value' => 0
		            ));
		        echo '</fieldset>';

				// echo '<fieldset><legend> ' .__('Necessary Power Points to get Badge') . '</legend>';
		  //       foreach ($powerpoints as $power) {
		  //           $previous = 0;
		  //           foreach ($mypp as $pp) {
		  //               if($pp['BadgePowerPoint']['power_points_id'] == $power['PowerPoint']['id'] && $pp['BadgePowerPoint']['badge_id'] == $m['Badge']['id'])
		  //                   $previous = $pp['BadgePowerPoint']['quantity'];
		  //           }
		  //           echo $this->Form->input('Power.' . $power['PowerPoint']['id'] . '.quantity', array(
		  //               'label' => $power['PowerPoint']['name']
		  //           ));
		  //       }
		  //       echo '</fieldset>';

		        echo $this->Form->radio('power_points_only', array(1 => 'Yes', 0 => 'No'), array('label' => __('Obtained exclusively with power points'), 'required' => true, 'default' => 1));
								
				echo $this->Form->hidden('organization_id', array('value' => $organization['Organization']['id']));

			?>
			<button class="button tiny" type="submit">
				<?php echo __('Save Changes')?>
			</button>
			<?php echo $this->Form->end(); ?>

		  <a class="close-reveal-modal">&#215;</a>
		</div>

	  </li>

	  <li>
		<input type="search" class="light-table-filter" data-table="order-table-users" placeholder="<?= __('Search user') ?>">
		<table class="order-table-users paginated" id = "usersTable">
			<thead>
				<tr>
					<th width="25"><input type="checkbox" onclick="checkAll('usersTable', 'user')" name="chk[]" id="user" /></th>
					<th><?= _('Users') ?></th>
		      		<th width="25"></th>
		      		<th width="25"><a href="#" data-reveal-id="myModalAddUser"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new user -->
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $m): ?>
		  		<tr>
		  		  <td><input type="checkbox" name="chkbox[]"></td> 
			      <td><?= $m['User']['name'] ?></td>
			      <td><a href="#" data-reveal-id="myModalEditUser<?= $m['User']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
			      <td><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'panel_delete', $m['User']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
			    </tr>

			    <?= $this->element('panel/edit_user', array('m' => $m)) ?>
			<?php endforeach; ?>
			</tbody>
		</table>

		<?= $this->element('panel/add_user', array('origin' => 'dashboard', 'organization' => $organization)) ?>

	  </li>

	  <!-- <li>
		<input type="search" class="light-table-filter" data-table="order-table-users" placeholder="<?= __('Search user') ?>">
		<table class="order-table-users paginated" id = "usersTable">
			<thead>
				<tr>
					<th width="25"><input type="checkbox" onclick="checkAll('usersTable', 'user')" name="chk[]" id="user" /></th>
					<th><?= _('Users') ?></th>
		      		<th width="25"></th>
		      		<th width="25"><a href="#" data-reveal-id="myModalAddUser"><i class="fa fa-plus fa-lg"></i></a></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$evokations = array_merge($pending_evokations, $approved_evokations);

				foreach($evokations as $m): ?>

		  		<tr>
		  		  <td><input type="checkbox" name="chkbox[]"></td> 
			      <td><?= $m['Evokation']['title'] ?></td>
			      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
			      <td><i class="fa fa-times fa-lg"></i></td>
			    </tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	  </li> -->

	</ul>

  </div>
</div>

<?php 
	//echo $this->Html->script('/webroot/components/jquery/jquery.min.js');
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	
	$(document).foundation(); 
	
	// function checkAll(id, id1){
	//     var tab = document.getElementById(id); // table with id tbl1
	//     var elems = tab.getElementsByTagName('input');
	//     var len = elems.length;

	//     if($('#' + id1).is(":checked")) {
	// 	    for(var i = 0; i<len; i++){
	// 	    	if(elems[i].type == "checkbox")
	// 	    		elems[i].checked = true;
	// 	    }
	// 	} else{
	// 		for(var i = 0; i<len; i++){
	// 	    	if(elems[i].type == "checkbox")
	// 	    		elems[i].checked = false;
	// 	    }
	// 	}
	// }

	// // Implements search in tables
	// (function(document) {
	// 	'use strict';

	// 	var LightTableFilter = (function(Arr) {

	// 		var _input;

	// 		function _onInputEvent(e) {
	// 			_input = e.target;
	// 			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
	// 			Arr.forEach.call(tables, function(table) {
	// 				Arr.forEach.call(table.tBodies, function(tbody) {
	// 					Arr.forEach.call(tbody.rows, _filter);
	// 				});
	// 			});
	// 		}

	// 		function _filter(row) {
	// 			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
	// 			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
	// 		}

	// 		return {
	// 			init: function() {
	// 				var inputs = document.getElementsByClassName('light-table-filter');
	// 				Arr.forEach.call(inputs, function(input) {
	// 					input.oninput = _onInputEvent;
	// 				});
	// 			}
	// 		};
	// 	})(Array.prototype);

	// 	document.addEventListener('readystatechange', function() {
	// 		if (document.readyState === 'complete') {
	// 			LightTableFilter.init();
	// 		}
	// 	});

	// })(document);

	//Paginates tables
	// $('table.paginated').each(function() {
	//     var currentPage = 0;
	//     var numPerPage = 10;
	//     var $table = $(this);
	//     $table.bind('repaginate', function() {
	//         $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
	//     });
	//     $table.trigger('repaginate');
	//     var numRows = $table.find('tbody tr').length;
	//     var numPages = Math.ceil(numRows / numPerPage);
	//     var $pager = $('<div class="pager"></div>');
	//     for (var page = 0; page < numPages; page++) {
	//         $('<a class="page-number"></a>').text(page + 1).bind('click', {
	//             newPage: page
	//         }, function(event) {
	//             currentPage = event.data['newPage'];
	//             $table.trigger('repaginate');
	//             $(this).addClass('active').siblings().removeClass('active');
	//         }).appendTo($pager).addClass('clickable');
	//     }
	//     $pager.insertAfter($table).find('a.page-number:first').addClass('active');
	// });

</script>