<!-- TOP-BAR -->
<div class="row standard-width">
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
			<!-- Right Nav Section -->
			<ul class="right">
				<!-- USERNAME AND PASSWORD -->
				<li>
					<div class="column">
						<input type="text" id="right-label" placeholder="username" class="radius">
					</div>
				</li>
				<li>
					<div class="column">
						<input type="text" id="right-label" placeholder="password" class="radius">
					</div>
				</li>
				<li>
					<div class="column">
						<a href="#" class="button">Sign in</a>
					</div>
				</li>
				<!-- OTHER SIGN IN METHODS -->
				<li>
					<div class="right">
						OR
						<a href="<?php echo $fbLoginUrl; ?>">
							<i class="fa fa-facebook fa-1x evoke login facebook-icon"></i>
						</a>

						<a href="<?php echo $fbLoginUrl; ?>">
							<i class="fa fa-google fa-1x evoke login google-icon"></i>
						</a>
					</div>
				</li>
			</ul>
		</section>
	</nav>
</div>

<?php echo $this->fetch('content'); ?>