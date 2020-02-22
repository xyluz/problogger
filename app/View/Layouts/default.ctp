<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>	
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('styles');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	<!-- CDN CSS  -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
           
				
				<?php echo $this->Html->image('logo.png', array('alt' => 'CakePHP','class' => 'navbar-brand-img', 'border' => '0', 'width'=>'15%')); ?>
		
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarCollapse">
 
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fe fe-x"></i>
                    </button> 
               
                    <ul class="navbar-nav ml-auto mr-5">
                        <li class="nav-item">                           
							
							<?php 

							echo $this->Html->link('Home',	array('controller' => 'pages','action' => 'index','full_base' => true),array('class'=>'nav-link'));

							?>                
                           
                        </li>
                        <li class="nav-item">
                          
							<?php 

							if($user):
								
							echo $this->Html->link('Posts',	array('controller' => 'posts','action' => 'index','full_base' => true),array('class'=>'nav-link'));

							endif

							?>
                        </li>
                    </ul>
				

				<?php if($user): ?>

					Hello,  <?php echo $user['first_name']; ?> (<?php echo $user['Group']['name'] ?>) Welcome back!

					
					<?php 
					
					echo $this->Form->postLink(__('Logout'), array('controller'=>'users','action' => 'logout'), array('class'=>'btn-sm btn-warning ml-2')); 

					if($user['Group']['name'] == 'Author' || $user['Group']['name'] == 'Admin') :

					echo $this->Html->link('Dashboard',	array('controller' => 'posts','action' => 'index','full_base' => true),array('class'=>'navbar-btn btn btn-sm btn-secondary ml-2 mr-3'));

					endif
					?>
                    

				<?php  else : ?>

				
					<?php 
					echo $this->Html->link('Login',	array('controller' => 'users','action' => 'login','full_base' => true),array('class'=>'navbar-btn btn btn-sm btn-primary'));
					?>
				

				<?php endif ?>
                </div>
            </div>
        </nav>
	<div id="container">
		
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		
	</div>
</body>
</html>
