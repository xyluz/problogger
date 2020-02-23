<div class="row align-items-center justify-content-center">
    <div class="col-11">

	<div class="mt-4">
	
		<?php echo $this->Html->link(__('Create Post'), array('controller'=>'posts','action' => 'add'), array('class'=>'btn btn-success')); ?>
		<?php echo $this->Html->link(__('My Posts'), array('controller'=>'posts','action' => 'myposts'), array('class'=>'btn btn-info')); ?>

		<?php if($user['Group']['name'] == 'Admin'): ?>
		
			<?php echo $this->Html->link(__('Manage Users'), array('controller' => 'users','action' => 'index','full_base' => true), array('class'=>'btn btn-dark')); ?>

			<?php echo $this->Html->link(__('Create Users'), array('controller' => 'users','action' => 'add','full_base' => true), array('class'=>'btn btn-secondary')); ?>

		<?php endif ?>

	</div>
		<div class="users index">
			<h2><?php echo __('Users'); ?></h2>
			<table cellpadding="0" cellspacing="0" class="table">
			<thead>
			<tr>
					<th scope="col"><?php echo $this->Paginator->sort('id'); ?></th>
					<th scope="col"><?php echo $this->Paginator->sort('first_name'); ?></th>
					<th scope="col"><?php echo $this->Paginator->sort('last_name'); ?></th>
					<th scope="col"><?php echo $this->Paginator->sort('username'); ?></th>
					<th scope="col"><?php echo $this->Paginator->sort('email'); ?></th>					
					<th scope="col"><?php echo $this->Paginator->sort('group_id'); ?></th>			
					<th scope="col">Posts #</th>			
					<th scope="col"><?php echo $this->Paginator->sort('created'); ?></th>
					<th scope="col"><?php echo $this->Paginator->sort('modified'); ?></th>
					<th scope="col"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['email']); ?>&nbsp;</td>			
				<td>
					<?php echo h($user['Group']['name']); ?>
				</td>
				<td>
					<?php echo count($user['Post']) ?> &nbsp;
				</td>
				<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
				</td>
			</tr>
		<?php endforeach; ?>
			</tbody>
			</table>
			<p>
			<?php
			echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>	</p>
			<div class="Page navigation">
				<div class="pagination">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'page-item'));
					echo $this->Paginator->numbers(array('separator' => ''),array('class'=>'page-item'));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'page-item'));
				?>
				</div>
			</div>
		</div>

	</div>
</div>
