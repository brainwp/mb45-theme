<?php
/**
 * Template Name: Home page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

<div id="fullpage">
	<?php $args = array(
			'post_type'			=> 'page',
			'posts_per_page'	=> 500,
			'post_parent'		=> get_the_ID(),
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC'
		);
	$query = new WP_Query( $args );
	?>

<<<<<<< HEAD
	<div class="section">
		<div class="container-fluid">
			<div class="col-md-offset-1 col-md-5">
				<div class="theTitle">
					manicure + blowout 45 minutes
				</div>
				<div class="info col-md-8 hidden-xs">
					Chic Hair + Chic Nails in 45 Minutes
Mani + Blowout = $65
				</div>
				<a href="#" class="theButtom">
					view menu
				</a>
			</div>
		</div>
		<a href="#" class="theButtomM hidden-lg-down">
					view menus
		</a>
	</div>
	<div class="section two">
		<div class="container-fluid">
			<div class="col-md-offset-1 col-md-5">
				<div class="theTitle">
					manicure + blowout 45 minutes
				</div>
				<div class="info col-md-8 hidden-xs">
					Chic Hair + Chic Nails in 45 Minutes
Mani + Blowout = $65
				</div>
				<a href="#" class="theButtom">
					view menu
				</a>
			</div>
		</div>
		<a href="#" class="theButtomM hidden-lg-down">
					view menus
		</a>
	</div>


	<div class="section form">
		<div class="container-fluid">
			<div class="col-md-offset-1 col-md-5">
				<div class="theTitle">
					Want a more modern, beautiful & efficient life?
				</div>
				<div class="info col-md-8">
					Sign up for our emails to stay in-the-know on exclusive events, tips and offers. We promise we won’t spam you.
				</div>

			</div>

	<!-- FORMULARIO -->
			<div class="col-md-4 form col-md-pull-1 col-xs-12 col-sm-12">
				<form action="" id="" class="">
					<div class="col-md-6">
						<label>
							FIRST NAME
							<input type="text" name="">
						</label>

					</div>
					<div class="col-md-6">
						<label>
							LAST NAME
							<input type="text" name="">
						</label>
=======
	<?php if ( $query->have_posts() ) : ?>
		<?php while( $query->have_posts() ) : $query->the_post();?>
		<?php $style = '';?>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php $style = sprintf( 'background-image:url(%s);', get_the_post_thumbnail_url( get_the_ID(), 'full') );?>
		<?php endif;?>
		<?php $class = 'color-white';?>
		<?php if ( $value = get_post_meta( get_the_ID(), 'text_color', true ) ) : ?>
			<?php $class = sprintf( 'color-%s', esc_attr( strtolower( $value ) ) );?>
		<?php endif;?>
		<div class="section <?php echo $class;?>" style="<?php echo esc_attr( $style );?>">
			<div class="container-fluid">
				<div class="col-md-offset-1 col-md-5">
					<div class="theTitle">
						<?php the_title();?>
>>>>>>> 4f1f6449d950c54b499e23f3d80ed4f02df0657b
					</div>
					<div class="info col-md-8 hidden-xs">
						<?php the_content();?>
					</div>
					<?php if ( $value = get_post_meta( get_the_ID(), 'link_url', true ) ) : ?>
						<a href="<?php echo esc_url( $value );?>" class="theButtom">
							<?php echo apply_filters( 'the_title', get_post_meta( get_the_ID(), 'link_text', true ) );?>
						</a>
					<?php endif;?>
				</div>
				<?php if ( $value = get_post_meta( get_the_ID(), 'content_right', true ) ) : ?>
					<div class="col-md-4 form col-md-pull-1 col-xs-12 col-sm-12">
						<?php echo apply_filters( 'the_content', $value );?>
					</div>
				<?php endif;?>

			</div>
			<?php if ( $value = get_post_meta( get_the_ID(), 'link_url', true ) ) : ?>
				<a href="<?php echo esc_url( $value );?>" class="theButtomM hidden-lg-down">
					<?php echo apply_filters( 'the_title', get_post_meta( get_the_ID(), 'link_text', true ) );?>
				</a>
			<?php endif;?>
		</div>
		<?php endwhile;?>
		<?php wp_reset_postdata();?>
	<?php endif;?>

</div>

<?php
get_footer();
