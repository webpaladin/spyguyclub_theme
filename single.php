<?php get_header(); ?>

<main class="single">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post">
				<h1><?php the_title(); ?></h1>
				<?php $category = get_the_category(); ?>
				<div class="category">
					<a href="/category/<?php echo $category[0]->slug; ?>"><?php echo $category[0]->name; ?></a>
				</div>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="thumbnail"><?php the_post_thumbnail( 'full' ); ?></div>
				<?php } ?>
				<?php the_content(); ?>
			</article>
		<?php endwhile; else: ?>
	<?php endif; ?>
</div>
</main>

<?php get_footer(); ?>