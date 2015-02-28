<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//on importe le css de foundation 
		echo $this->Html->css('foundation');

		//ici on importe jQuery (donné par foundation) et le javascript du framework foundation
		echo $this->Html->script('vendor/jquery.js');
		echo $this->Html->script('vendor/fastclick.js');
		echo $this->Html->script('foundation.min.js');
		
		//balises de cakePHP qui ira placer ici des éventuels ajouts de scripts et de design qui vous mettrez dans vos pages
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>


	<?php 
		//ici on importe un élément (ie un fichier de contenu affiché qui servira à plusieurs endroits)
		//il se trouve dans app/Views/Elements
		echo $this->element('navigation_bar'); 
	?>
	<?php 
		// et un autre (séparé pour plus de clarté)
		echo $this->element('sub_navigation_text'); 
	?>

	<div id="container">
		<div id="content">
			<div class="panel">


			<?php //ici on affiche les messages flash (avant le contenu de la vue)
				echo $this->Session->flash(); 
			?>

			<?php
				// la ligne suivante affiche le contenu rendu de la page de vue.
				echo $this->fetch('content'); 
			?>

			</div>
		</div>

		<?php // en dessous d'ici, le footer, rien à signaler de particulier ?>
		<div id="footer">
			<div class='row'>
				<div class='large-12 columns'>
					<p> Auteur : Elsa Martel et Niels Benichou - Année 2015 </p>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

	<?php //ce script qui suit sert à activer certains éléments de foundation dans les pages ?>
	<script>
	  $(document).foundation();
	</script>

</body>



</html>