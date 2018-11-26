<?php 
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package seed
 * iworn test edit
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-img"><?php the_post_thumbnail('full'); ?></div>
			
			<div class="container">
				<header class="entry-header">
					<h1 class="entry-title" style="background-color: <?php the_field('color'); ?>;"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="row">
						<div class="col-sm-9">
							<?php the_content(); ?>
						</div>
						
						<div class="col-sm-3">
							<table class="table table-bordered">
							
							<!-- add avatar , author -->
							<tr><th id="anim-avatar"><?php echo get_avatar(get_the_author_meta('ID'), 128 )?> </th>
							<td><p style="text-transform:uppercase;"><strong>สร้างสรรค์โดย: </strong><?php echo get_the_author_meta('nickname') ?></p></td></tr>
							<!-- end avatar , author -->					
							
								<tr><th>Year</th><td><?php the_field('year'); ?></td></tr> 	
								
								<?php   
									$terms = get_the_terms( $post->ID , 'project_category' );
									if ( $terms != null ){
										echo '<tr><th>Division</th><td>';
										foreach( $terms as $term ) {
											if (($term->slug) != 'featured') {
												echo '<a href="'. get_term_link( $term ) .'" style="color:'.get_field('color').'";>'. $term->name .'</a><br>';
												unset($term);
											}
										}
										echo '</td></tr>';
									} 
								?>
								
								<?php   // 
									$terms = get_the_terms( $post->ID , 'anim_project_name' );
									if ( $terms != null ){
										echo '<tr><th>Projects</th><td>';
										foreach( $terms as $term ) {
											echo '<a href="'. get_term_link( $term ) .'" style="color:'.get_field('color').'";>'. $term->name .'</a><br>';
										}
										echo '</td></tr>';
									} 
								?>
								
								<tr><th>Color</th><td><span class="project-color" style="background-color: <?php the_field('color'); ?>;"></span></td></tr>
								
								</table>
						</div>
					</div>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php seed_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</div><!--container-->
		</article><!-- #post-## -->

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
