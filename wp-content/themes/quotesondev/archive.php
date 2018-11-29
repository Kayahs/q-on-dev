<?php
/**
 * The template for displaying archive pages.
 * Template Name: Archive Template
 * @package QOD_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      </header>
      <?php
		    $argsarr = array (
            'posts_per_page' => -1,
            'post_type' => 'post'
          );
        $first_query = new WP_Query( $argsarr );
        
        if ( $first_query->have_posts()) : ?>
          <h2>Quote Authors</h2>
          <ul class="author-list">
          <?php while($first_query->have_posts()) : $first_query->the_post(); 
            ?>
            <li><a href="<?php echo esc_url(the_permalink());?>">
              <?php
            the_title('', '</a></li>');

          endwhile;?>
          </ul>
        <?php else : ?>

      <?php endif; 
        $argsarr = array (
            'orderby' => 'name',
            'order' => 'ASC'
          );
        $categories = get_categories($argsarr);?>
        <h2>Categories</h2>
        <ul class="category-list">
        <?php foreach ($categories as $category) {
          $categorylink = home_url('/category/') . $category->slug;
        ?>
        <li><a href="<?php echo $categorylink ?>"><?php echo $category->name ?></a></li>
        <?php } ?>
        </ul> 
        <?php 
        $argsarr = array (
            'orderby' => 'name',
            'order' => 'ASC'
          );
        $tags = get_tags($argsarr);?>
        <h2>Tags</h2>
        <ul class="tag-list">
          <?php foreach ($tags as $tag) {
            $taglink = home_url('/tag/') . $tag->slug;
            ?>
            <li><a href="<?php echo $taglink ?>"><?php echo $tag->name ?></a></li>
         <?php } ?>
        </ul>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
