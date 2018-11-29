<?php
/**
 * The template for displaying category pages.
 *
 * @package QOD_Starter_Theme
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <?php
          the_archive_title( '<h1 class="page-title">', '</h1>' );
        ?>
      </header><!-- .page-header -->

      <?php 
        $query_vars = $wp_query->query_vars;
        $query_vars['posts_per_page'] = 5;
        $new_query = new WP_Query($query_vars);
        while ( $new_query->have_posts() ) : $new_query->the_post(); 
        $quoteSource = get_post_meta(get_the_ID(), "_qod_quote_source", true);
        $quoteSourceURL = get_post_meta(get_the_ID(), "_qod_quote_source_url", true);
          ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <div class="entry-meta">
        <?php the_title("<h2 class='entry-title'>— ","</h2>"); ?>
        <span class="source">
          <?php 
          if ($quoteSource) {
            echo ($quoteSourceURL) ? ", <a href='$quoteSourceURL'>$quoteSource</a>" : ", $quoteSource";
          }

          ?>
        </span>
      </div>
      </article>
      <?php endwhile; ?>
        <?php qod_numbered_pagination(); ?>
    <?php else : ?>


    <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>
