<div class="superheroIdentities view">
<h2><?php echo __('Superhero Identity'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality 1'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['quality_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality 2'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['quality_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PrimaryPower'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['primaryPower']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SecondaryPower'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['secondaryPower']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($superheroIdentity['SuperheroIdentity']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Superhero Identity'), array('action' => 'edit', $superheroIdentity['SuperheroIdentity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Superhero Identity'), array('action' => 'delete', $superheroIdentity['SuperheroIdentity']['id']), array(), __('Are you sure you want to delete # %s?', $superheroIdentity['SuperheroIdentity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Superhero Identities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Superhero Identity'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Innovator Qualities'), array('controller' => 'social_innovator_qualities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quality1'), array('controller' => 'social_innovator_qualities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Powers'), array('controller' => 'powers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Power1'), array('controller' => 'powers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Social Innovator Qualities'); ?></h3>
	<?php if (!empty($superheroIdentity['Quality1'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality1']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality1']['name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality1']['short_name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality1']['description']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality1']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality1']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Quality1'), array('controller' => 'social_innovator_qualities', 'action' => 'edit', $superheroIdentity['Quality1']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Social Innovator Qualities'); ?></h3>
	<?php if (!empty($superheroIdentity['Quality2'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality2']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality2']['name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality2']['short_name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality2']['description']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality2']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Quality2']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Quality2'), array('controller' => 'social_innovator_qualities', 'action' => 'edit', $superheroIdentity['Quality2']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Powers'); ?></h3>
	<?php if (!empty($superheroIdentity['Power1'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Power1']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Power1']['name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Power1']['description']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Power1'), array('controller' => 'powers', 'action' => 'edit', $superheroIdentity['Power1']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Powers'); ?></h3>
	<?php if (!empty($superheroIdentity['Power2'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Power2']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Power2']['name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
	<?php echo $superheroIdentity['Power2']['description']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Power2'), array('controller' => 'powers', 'action' => 'edit', $superheroIdentity['Power2']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($superheroIdentity['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Facebook Id'); ?></th>
		<th><?php echo __('Facebook Token'); ?></th>
		<th><?php echo __('Google Id'); ?></th>
		<th><?php echo __('Google Token'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Lastname'); ?></th>
		<th><?php echo __('Birthdate'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Biography'); ?></th>
		<th><?php echo __('Mini Biography'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Level'); ?></th>
		<th><?php echo __('Facebook'); ?></th>
		<th><?php echo __('Twitter'); ?></th>
		<th><?php echo __('Google Plus'); ?></th>
		<th><?php echo __('Instagram'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('Blog'); ?></th>
		<th><?php echo __('Country'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Basic Training'); ?></th>
		<th><?php echo __('Photo Dir'); ?></th>
		<th><?php echo __('Photo Attachment'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Superhero Identity Id'); ?></th>
		<th><?php echo __('Primary Power Quantity'); ?></th>
		<th><?php echo __('Secondary Power Quantity'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($superheroIdentity['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['role_id']; ?></td>
			<td><?php echo $user['facebook_id']; ?></td>
			<td><?php echo $user['facebook_token']; ?></td>
			<td><?php echo $user['google_id']; ?></td>
			<td><?php echo $user['google_token']; ?></td>
			<td><?php echo $user['organization_id']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['firstname']; ?></td>
			<td><?php echo $user['lastname']; ?></td>
			<td><?php echo $user['birthdate']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['sex']; ?></td>
			<td><?php echo $user['biography']; ?></td>
			<td><?php echo $user['mini_biography']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['level']; ?></td>
			<td><?php echo $user['facebook']; ?></td>
			<td><?php echo $user['twitter']; ?></td>
			<td><?php echo $user['google_plus']; ?></td>
			<td><?php echo $user['instagram']; ?></td>
			<td><?php echo $user['website']; ?></td>
			<td><?php echo $user['blog']; ?></td>
			<td><?php echo $user['country']; ?></td>
			<td><?php echo $user['language']; ?></td>
			<td><?php echo $user['basic_training']; ?></td>
			<td><?php echo $user['photo_dir']; ?></td>
			<td><?php echo $user['photo_attachment']; ?></td>
			<td><?php echo $user['status']; ?></td>
			<td><?php echo $user['superhero_identity_id']; ?></td>
			<td><?php echo $user['primary_power_quantity']; ?></td>
			<td><?php echo $user['secondary_power_quantity']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
