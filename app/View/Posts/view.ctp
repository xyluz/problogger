<section class="pt-8 pt-md-11">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                
                <h1 class="display-4 text-center">
                <?php echo h($post['Post']['title']); ?>
               </h1>
                
                <p class="lead mb-7 text-center text-muted">
                <?php echo h($post['Post']['except']); ?>
              </p>
                
                <div class="row align-items-center py-5 border-top border-bottom">
                    
                    <div class="col ml-n5">                        
                        <h6 class="text-uppercase mb-0">

                  By <?php echo $post['User']['first_name'] . ' ' . $post['User']['last_name'] ?> </h6>
                        
                        <time class="font-size-sm text-muted" datetime="2019-05-20">
                            Published on <?php echo $this->Time->format('F jS, Y h:i A', $post['Post']['created']); ?>
</time>
                    </div>
                   
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-9 col-xl-8">
   
            <?php echo h($post['Post']['content']); ?>
            </div>   
        </div>  

    

        <!-- / .row -->
    </div>     

    <!-- / .container -->
</section>