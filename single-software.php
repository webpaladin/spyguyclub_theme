<?php get_header(); ?>

<main class="single">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post">
				<?php the_content(); ?>
			</article>
		<?php endwhile; else: ?>
	<?php endif; ?>
</div>
</main>

<?php get_footer(); ?>