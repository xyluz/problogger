<section class="pt-5 pt-md-10 bg-light">
    <div class="container">
        <div class="row align-items-center mb-5">

            <?php if($user['Group']['name'] == 'Author' || $user['Group']['name'] == 'Admin'): ?>

            <div class="col-12 col-md">

                <h3 class="mb-0">You have </h3>
    
                <p class="mb-0 text-muted">

                    <?php echo $userCount ?> Posts 

                </p>
                <div class="mt-4">
                    <?php echo $this->Html->link(__('Create Post'), array('action' => 'add'), array('class'=>'btn btn-success')); ?>
                    <?php echo $this->Html->link(__('My Posts'), array('action' => 'myposts'), array('class'=>'btn btn-info')); ?>

                    <?php if($user['Group']['name'] == 'Admin'): ?>
                    
                        <?php echo $this->Html->link(__('Manage Users'), array('controller' => 'users','action' => 'index','full_base' => true), array('class'=>'btn btn-dark')); ?>

                        <?php echo $this->Html->link(__('Create Users'), array('controller' => 'users','action' => 'add','full_base' => true), array('class'=>'btn btn-secondary')); ?>

                
                    <?php endif ?>

                </div>
            </div>
            
        </div>    
                <?php endif ?>
         <div class="row align-items-center mb-5">
            <div class="col-12 col-md">

                <h3 class="mb-0">
        Latest Posts </h3>
    
                <p class="mb-0 text-muted">
        Here’s what people are saying. </p>
            </div>
            
        </div>                 


        <div class="row">

        <?php foreach ($posts as $post): ?>

            <div class="col-12 col-md-6 col-lg-4 d-flex mt-3">
                
                <div class="card mb-6 mb-lg-0 shadow-light-lg">
                    
                    
                    <div class="card-body"> 
                        <h3><?php echo h($post['Post']['title']); ?> </h3> 
                        <p class="mb-0 text-muted"><?php echo h($post['Post']['except']); ?> </p> 
                    </div>
                    
                    <div class="card-meta mt-auto"> 
                        <hr class="card-meta-divider"> 
                        <h6 class="text-uppercase text-muted mr-2 mb-0 pl-3"><?php echo $post['User']['first_name'] . ' ' . $post['User']['last_name'] ?> </h6> 
                        <p class="h6 text-uppercase text-muted mb-0 ml-auto pl-3"> 
                            <time datetime="2019-05-02"><?php echo $this->Time->format('F jS, Y h:i A', $post['Post']['created']); ?>
                            
                            </time> 
                        </p> 
                        <div class='row mt-2 mb-2 pl-3'>
                            <div class='col'>
                                <?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>  
                            </div>

                            <?php if(($user['Group']['name'] == 'Author' && $post['User']['id'] == $user['id']) || $user['Group']['name'] == 'Admin') : ?>

                            <div class="col">                      
                                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
                            </div>
                            <div class="col">
                                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id'])), array('class'=>'btn btn-danger')); ?>
                            </div>

                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
            
          <?php endforeach; ?>      
    
        </div>                 

    </div>             


</section>
