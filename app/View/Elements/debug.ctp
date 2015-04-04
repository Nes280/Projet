<?php if(Configure::read('debug')>=2): ?>
	<table>
		<caption>
			Contenue de la session
		</caption>
		<thread>
			<tr><th>$session->read();</th></tr>
		</thread>
		<tbody>
			<tbody>
				<tr>
					<td><?php debug($this->Session->read()); ?></td>
				</tr>
			</tbody>
		</tbody>
	</table>
	<?php echo $this->element('sql_dump'); ?>
<?php endif; ?>
