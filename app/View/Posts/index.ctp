<h1>Liste des filmes</h1>
<p> GENRE : </p>
<?php foreach ($posts as $post): ?>
    <?php echo '<p>'.$this->Html->link($post['Post']['titre'],
        array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])).'</p>'; ?>
<?php endforeach; ?>
<?php unset($post); ?>
