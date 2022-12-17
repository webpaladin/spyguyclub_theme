<?php get_header(); ?>

<main class="blog">
	<div class="container">
		<?php $page = get_posts([ 'name' => 'blog', 'post_type' => 'page' ]);

		if ( $page )
		{
			echo '<div class="page-content">';
			echo $page[0]->post_content;
			echo '</div>';
		} ?>

		<ul class="cat-block">
			<li><a href="/blog/">All</a></li>
			<?php $categories = get_categories( array('hide_empty' => 1) ); 
			foreach ($categories as $cat) {
				echo '<li><a href="/category/'.$cat->slug.'">'.$cat->name.'</a></li>';
			}?>
			</ul>

			<div class="posts-block">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<a class="post" href="<?php the_permalink(); ?>">
						<?php $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
						<div class="image" style="background-image: url(<?php echo $thumb_url[0]; ?>)">
							<?php $category = get_the_category(); ?>
							<span><?php echo $category[0]->name; ?></span>
						</div>
						<h2><?php the_title(); ?></h2>
						<p><?php echo mb_substr( strip_tags( get_the_content() ), 0, 100 ); ?>...</p>
					</a>

				<?php endwhile; else: ?>

			<?php endif; ?>

		</div>

	</div>
</main>

<?php get_footer(); ?>