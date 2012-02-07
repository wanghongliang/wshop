<div class="db-fs14" >

	<?php $canEdit   = ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')); ?>
	<?php if ($this->item->state == 0) : ?>
	<div class="system-unpublished">
	<?php endif; ?>

	<?php 



	if ($this->item->params->get('show_title') || $this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
	<table width=100% class="contentpaneopen<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
	<tr>
		<?php if ($this->item->params->get('show_title')) : ?>
		<td class="contentheading<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>" width="100%">
			<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
			<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
				<?php echo WString::substr($this->escape($this->item->title),0,10); ?></a>
			<?php else : ?>
				<?php echo WString::substr($this->escape($this->item->title),0,10); ?>
			<?php endif; ?>

			





		</td>
		<?php endif; ?>


		<?php if ($this->item->params->get('show_create_date')) : ?>

			<td valign="top" colspan="2" class="createdate">
				<?php echo WHTML::_('date', $this->item->created, WText::_('DATE_FORMAT_LC4')); ?>
			</td>

		<?php endif; ?>

		<?php /***  ?>



		<?php if ($this->item->params->get('show_pdf_icon')) : ?>
		<td align="right" width="100%" class="buttonheading">
		<?php echo WHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?>
		</td>
		<?php endif; ?>

		<?php if ( $this->item->params->get( 'show_print_icon' )) : ?>
		<td align="right" width="100%" class="buttonheading">
		<?php echo WHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?>
		</td>
		<?php endif; ?>

		<?php if ($this->item->params->get('show_email_icon')) : ?>
		<td align="right" width="100%" class="buttonheading">
		<?php echo WHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?>
		</td>
		<?php endif; ?>
		 
		<?php if ($canEdit) : ?>
		   <td align="right" width="100%" class="buttonheading">
		   <?php echo WHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
		   </td>
	   <?php endif; ?>



		<?php ***/ ?>

	</tr>
	</table>
	<?php endif; ?>
	<?php  if (!$this->item->params->get('show_intro')) :
		echo $this->item->event->afterDisplayTitle;
	endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>
	<table class="contentpaneopen<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
	<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
	<tr>
		<td>
			<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
			<span>
				<?php if ($this->item->params->get('link_section')) : ?>
					<?php echo '<a href="'.WRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
				<?php endif; ?>
				<?php echo $this->item->section; ?>
				<?php if ($this->item->params->get('link_section')) : ?>
					<?php echo '</a>'; ?>
				<?php endif; ?>
					<?php if ($this->item->params->get('show_category')) : ?>
					<?php echo ' - '; ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
			<span>
				<?php if ($this->item->params->get('link_category')) : ?>
					<?php echo '<a href="'.WRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
				<?php endif; ?>
				<?php echo $this->item->category; ?>
				<?php if ($this->item->params->get('link_category')) : ?>
					<?php echo '</a>'; ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
	<tr>
		<td width="70%"  valign="top" colspan="2">
			<span class="small">
				<?php WText::printf( 'Written by', ($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author) ); ?>
			</span>
			&nbsp;&nbsp;
		</td>
	</tr>
	<?php endif; ?>



	<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
	<tr>
		<td valign="top" colspan="2">
			<a href="http://<?php echo $this->item->urls ; ?>" target="_blank">
				<?php echo $this->item->urls; ?></a>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
	<td valign="top" colspan="2">
	<?php if (isset ($this->item->toc)) : ?>
		<?php echo $this->item->toc; ?>
	<?php endif; ?>
	<?php //echo $this->item->text; ?>
	</td>
	</tr>

	<?php 
	/**
	if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
	<tr>
		<td colspan="2"  class="modifydate">
			<?php echo WText::_( 'Last Updated' ); ?> ( <?php echo WHTML::_('date', $this->item->modified, WText::_('DATE_FORMAT_LC2')); ?> )
		</td>
	</tr>
	<?php endif; 

	**/

	?>

	<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
	<tr>
		<td  colspan="2">
			<a href="<?php echo $this->item->readmore_link; ?>" class="readon<?php echo $this->item->params->get('pageclass_sfx'); ?>">
				<?php if ($this->item->readmore_register) :
					echo WText::_('Register to read more...');
				elseif ($readmore = $this->item->params->get('readmore')) :
					echo $readmore;
				else :
					echo WText::sprintf('Read more...');
				endif; ?></a>
		</td>
	</tr>
	<?php endif; ?>

	</table>

	<?php if ($this->item->state == 0) : ?>
	</div>
	<?php endif; ?>
	<span class="article_separator">&nbsp;</span>
	<?php echo $this->item->event->afterDisplayContent; ?>

</div>