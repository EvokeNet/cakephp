<?php

/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

<div class="centering-block forums background-color">

	<div class="forums main-title container">
		<div class="forums main-title">
			Forum
		</div>
	</div>

	<!-- FORUMS -->
	<d1 class="accordion forums accordion" data-accordion>

	<?php foreach ($forums as $forum): ?>
		<dd class="accordion-navigation">
			<a class = "forums title main" href="#forum<?= $forum['Forum']['id'] ?>">
				<i class="forums quote fa fa-quote-right fa-2x text-color-highlight padding-right-10px "></i><?= $forum['Forum']['title'] ?>
			</a>
			<div class="content forums content main" id="forum<?= $forum['Forum']['id'] ?>">
				<div class="forums description"><?= $forum['Forum']['description'] ?> </div>

				<!-- FORUM'S CATEGORIES -->
				<div>
					<?php foreach ($forumCategories[$forum['Forum']['id']] as $forumCategory): ?>
					<div class="forums category">
						<div class="evoke text-glow forums category-title">
							<?= $forumCategory['ForumCategory']['title'] ?>
						</div>
						<div class="forums category-description">
							<?= $forumCategory['ForumCategory']['description'] ?>
						</div>
						<?php if(isset($forumCategory['ForumCategory']['id'])): ?>
							<a class="button thin" href="<?php echo $this->Html->url(array('controller' => 'ForumCategories', 'action' => 'view', 'admin' => false, $forumCategory['ForumCategory']['id'])); ?>">
								Enter Forum Discussion
							</a>
						<?php endif; ?>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</dd>
	<?php endforeach; ?>

	</d1>

	<!-- PAGING -->
	<div class="forums paging centered">
		<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
		<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
		<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
	</div>
</div>
