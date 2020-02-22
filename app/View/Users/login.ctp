<div class="row align-items-center justify-content-center">
    <div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">
       
        <h1 class="mb-0 font-weight-bold text-center"> Sign in </h1>
       
        <p class="mb-6 text-center text-muted">Private. Elegant. Simple </p>
        <!-- Form -->
    
        <?php echo $this->Form->create('User'); ?>
            <!-- Email -->
            <div class="form-group">
                <?php echo $this->Form->input('username',array('class'=>'form-control')); ?>
                
            </div>
            <!-- Password -->
            <div class="form-group">
                <?php echo $this->Form->input('password',array('class'=>'form-control')); ?>                
            </div>
           <?php echo $this->Form->submit('Login',array('class'=>'btn btn-primary btn-block')); ?>

           <?php echo $this->Form->end(); ?>
        
    </div>
</div>