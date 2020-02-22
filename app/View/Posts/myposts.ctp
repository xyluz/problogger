<section class="pt-5 pt-md-10 bg-light">
    <div class="container">
        <div class="row align-items-center mb-5">
            
         <div class="row align-items-center mb-5">
            <div class="col-12 col-md">

                <h3 class="mb-0">
        Your Posts</h3>
    
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
                            <div class="col">                      
                                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
                            </div>
                            <div class="col">
                                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id'])), array('class'=>'btn btn-danger')); ?>
                            </div>                          

                        </div>
                    </div>
                </div>
            </div>
            
          <?php endforeach; ?>      
    
        </div>                 

    </div>             


</section>
