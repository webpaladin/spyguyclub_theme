
<footer>
	<div class="container">
		<div class="left">
			<div class="top">
				<div class="logo">
					<img src="<?php bloginfo('template_url'); ?>/img/logo-footer.png" alt="logo">
					<p>SPYGUY.CLUB</p>
				</div>
				<p class="copyright"><?php echo date("Y"); ?>. All Rights Reserved</p>
			</div>
			<div class="mail">
				<p>Get in touch:</p>
				<a href="mailto:team@spyguy.club">team@spyguy.club</a>
			</div>
		</div>
		<div class="right">
			<div class="item">
				<h3>BRANDS</h3>
				<ul>
					<?php $query = new WP_Query( array('post_type' => 'software') );
					while ( $query->have_posts() ) {
						$query->the_post(); ?>

						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php }
					wp_reset_postdata();
					?>
				</ul>
			</div>
			<div class="item">
				<h3>PLATFORMS</h3>
				<ul>
					<?php $terms = get_terms([
						'taxonomy' => 'software_category',
						'hide_empty' => false,
					]);
					foreach ($terms as $term) {
						$term_slug = $term->slug;
						$term_name = $term->name;
						echo '<li><a href="/'.$term_slug.'/">'.$term_name.'</a></li>';
					}

					?>
				</ul>
			</div>
			<div class="item">
				<h3>OPERATIONAL SYSTEMS</h3>
				<ul>
					<?php $terms = get_terms([
						'taxonomy' => 'software_os',
						'hide_empty' => false,
					]);
					foreach ($terms as $term) {
						$term_slug = $term->slug;
						$term_name = $term->name;
						echo '<li><a href="/'.$term_slug.'/">'.$term_name.'</a></li>';
					}

					?>
				</ul>
			</div>
			<div class="item">
				<h3>DEVICES</h3>
				<ul>
					<?php $terms = get_terms([
						'taxonomy' => 'software_device',
						'hide_empty' => false,
					]);
					foreach ($terms as $term) {
						$term_slug = $term->slug;
						$term_name = $term->name;
						echo '<li><a href="/'.$term_slug.'/">'.$term_name.'</a></li>';
					}

					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<p class="bottom">Please refer to your local laws to make sure your particular monitoring activities are legal in your country. By installing the software or using the service you certify that you act in accordance to the law and you take full responsibility for the use of the product.</p>
	</div>
</footer>
<div id="bg"></div>
<?php wp_footer(); ?>
</body>
</html>