
<?php 
	$appDisplayTitle = $user ?  'Edit User' :  'Edit Account';
?>
<div class="row align-items-center justify-content-center">
    <div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">
       
        <h1 class="mb-0 font-weight-bold text-center"> 
		
			<?php echo $appDisplayTitle ?>
		
		</h1>
       
        <p class="mb-6 text-center text-muted">Private. Elegant. Simple </p>
       
		<?php 
			echo $this->Form->create('User'); 
			echo $this->Form->input('id'); 
		?>
       
            <div class="form-group">
                <?php echo $this->Form->input('first_name',array('class'=>'form-control')); ?>                
            </div>
			<div class="form-group">
                <?php echo $this->Form->input('last_name',array('class'=>'form-control')); ?>                
            </div>
			<div class="form-group">
                <?php echo $this->Form->input('email',array('class'=>'form-control')); ?>                
            </div>
			<div class="form-group">
                <?php echo $this->Form->input('username',array('class'=>'form-control')); ?>                
            </div>            
            <div class="form-group">
                <?php echo $this->Form->input('password',array('class'=>'form-control')); ?>                
            </div>
			<div class="form-group">
                <?php echo $this->Form->input('group_id',array('class'=>'form-control')); ?>                
            </div>
			
           <?php echo $this->Form->submit($appDisplayTitle,array('class'=>'btn btn-primary btn-block')); ?>

        <?php echo $this->Form->end(); ?>
        
    </div>
</div>

