<section class="pt-5 pt-md-10 bg-light">
    <div class="container">

<div class="row align-items-center mb-5">
            <div class="col-12 col-md">

                <h3 class="mb-0">
        Create Post </h3>
    
                <p class="mb-0 text-muted">
        Here’s what people are saying. </p>
            </div>
            
        </div>      
<?php echo $this->Form->create('Post'); ?>

    <div class="row">
        <div class="col-8">
            <div class="form-group mb-5">               
                <?php echo $this->Form->input('title',array('class'=>'form-control','placeholder'=>'Post Title')); ?>
            </div>
        </div>
    </div>

	<div class="row">
        <div class="col-8">
            <div class="form-group mb-5">               
                <?php echo $this->Form->input('except',array('class'=>'form-control','placeholder'=>'Post Excerpt')); ?>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-8">
            <div class="form-group mb-5">               
                <?php echo $this->Form->input('content',array('class'=>'form-control','placeholder'=>'Post Content')); ?>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-8">
            <div class="form-group mb-5">               
                <?php echo $this->Form->submit('Submit',array('class'=>'btn btn-primary')); ?>
            </div>
        </div>
    </div>	


<?php echo $this->Form->end(); ?>
    </div>
</div>



