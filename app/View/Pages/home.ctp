<section class="pt-4 pt-md-11">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-5 col-lg-6 order-md-2">
                        
						<?php echo $this->Html->image('illustration.png', array('alt' => 'CakePHP','class' => array('img-fluid','mw-md-150', 'mw-lg-130', 'mb-6', 'mb-md-0'), 'border' => '0', 'data-src' => 'illustration.png')); ?>  

                    </div>
                    <div class="col-12 col-md-7 col-lg-6">
                        
                        <h2 class="display-3 text-center text-md-left">
              Welcome to <span class="text-primary">ProBlogger</span></h2>
                        <h4>
                            Private. Elegant. Simple </h4>
                  
                        <p class="text-center text-md-left text-muted mb-6 mb-lg-8">
              A practice app for Geneo</p>

                <div class="text-center text-md-left">
                <?php 
                if($user):

                    echo $this->Form->postLink(__('Logout'), array('controller'=>'users','action' => 'logout'), array('class'=>'btn-sm btn-warning ml-2')); 

					if($user['Group']['name'] == 'Author' || $user['Group']['name'] == 'Admin') :

                    echo $this->Html->link('Dashboard',	array('controller' => 'posts','action' => 'index','full_base' => true),array('class'=>'navbar-btn btn btn-sm btn-secondary ml-2 mr-3'));

                    endif;
                
                else:
                    echo $this->Html->link('Login',	array('controller' => 'users','action' => 'login','full_base' => true), array('class'=>'btn btn-primary mr-1'));
                        
                    echo $this->Html->link('Register',	array('controller' => 'users','action' => 'add','full_base' => true), array('class'=>'btn btn-primary-soft'));	
                endif;
                ?>     
                    
                </div>
                       
                    </div>
                </div>                 
               
            </div>             
           
        </section>
