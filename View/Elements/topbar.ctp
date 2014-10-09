<!-- TOP-BAR -->
<div class="evoke login-top-bar row full-width padding top-1 bottom-1 vertical-align-top fixed sticky" id="top-bar-login">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1>
					<a href="#"><span>
						<!-- Logo -->
						<div class="left"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>'></div>
					</span></a>
				</h1>
			</li>
			
	    	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>

		<section class="top-bar-section">
			<?php echo $this->fetch('menu'); ?>
		</section>
	</nav>
</div>

<?php echo $this->fetch('content'); ?>