<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" type="image/x-icon" />

	<?php wp_head(); ?>
</head>
<body>
	<header>
		<div class="container">
			<div class="logo">
				<?php if (is_front_page()) { ?>
					<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="logo">
					<p>SPYGUY.CLUB</p>
				<?php } else { ?>
					<a href="/">
						<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="logo">
						<p>SPYGUY.CLUB</p>
					</a>
				<?php } ?>
			</div>
			<div class="label">
				<p>No1 Spy Software Marketplace</p>
			</div>
			<div class="block-menu">
				<nav class="filter-menu">
					<ul>
						<li>
							<span>by category</span>
							<ul class="sub-menu cc2">
								<?php $terms = get_terms([
									'taxonomy' => 'software_category',
									'hide_empty' => false,
								]);
								foreach ($terms as $term) {
									$term_slug = $term->slug;
									$term_name = $term->name;
    								$value = get_field( "image", $term->taxonomy . '_' . $term->term_id );
									echo '<li><a href="/'.$term_slug.'/"><img src="'.$value.'" width="30">'.$term_name.' Spy</a></li>';
								}

								 ?>
							</ul>
						</li>
						<li>
							<span>by device</span>
							<ul class="sub-menu">
								<?php $terms = get_terms([
									'taxonomy' => 'software_device',
									'hide_empty' => false,
								]);
								foreach ($terms as $term) {
									$term_slug = $term->slug;
									$term_name = $term->name;
    								$value = get_field( "image", $term->taxonomy . '_' . $term->term_id );
									echo '<li><a href="/'.$term_slug.'/"><img src="'.$value.'" width="30">'.$term_name.'</a></li>';
								}

								 ?>
							</ul>
						</li>
						<li>
							<span>by os</span>
							<ul class="sub-menu">
								<?php $terms = get_terms([
									'taxonomy' => 'software_os',
									'hide_empty' => false,
								]);
								foreach ($terms as $term) {
									$term_slug = $term->slug;
									$term_name = $term->name;
    								$value = get_field( "image", $term->taxonomy . '_' . $term->term_id );
									echo '<li><a href="/'.$term_slug.'/"><img src="'.$value.'" width="30">'.$term_name.' Spy</a></li>';
								}

								 ?>
							</ul>
						</li>
					</ul>
				</nav>
				<?php if ( has_nav_menu( 'topmenu' ) ) { ?>
					<?php wp_nav_menu(array(
						'container' 		=> 'nav',
						'container_class' 	=> 'topmenu',
						'theme_location' 	=> 'topmenu',
						'items_wrap' 		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
					));
					?>
				<?php } ?>
			</div>
			<div class="burger-container">
				<div class="mmenu">
					<div class="line1 line"></div>
					<div class="line2 line"></div>
					<div class="line3 line"></div>
				</div>
			</div>
		</div>
	</header>
	<?php echo $page_id = get_term_meta( 31, 'term_page', true ); ?>
