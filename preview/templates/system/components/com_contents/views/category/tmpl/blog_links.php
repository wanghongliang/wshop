 
<div>
	<strong><?php echo WText::_( 'More Articles...' ); ?></strong>
</div>
<ul>
<?php foreach ($this->links as $link) : ?>
	<li>
			<a class="blogsection" href="<?php echo WRoute::_('index.php?option=com_content&view=article&id='.$link->slug); ?>">
			<?php echo $link->title; ?></a>
	</li>
<?php endforeach; ?>
</ul>
