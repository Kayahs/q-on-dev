<?php
/**
 * Template part for displaying single posts.
 *
 * @package QOD_Starter_Theme
 */
  $quoteSource = get_post_meta(get_the_ID(), "_qod_quote_source", true);
  $quoteSourceURL = get_post_meta(get_the_ID(), "_qod_quote_source_url", true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
  <div class="entry-meta">
    <?php the_title( '<h1 class="entry-title">— ', '</h1>' ); ?>
  <span class="source">
    <?php 
    if ($quoteSource) {
      echo ($quoteSourceURL) ? ", <a href='$quoteSourceURL'>$quoteSource</a>" : ", $quoteSource";
    }

    ?>
  </span>
  </div>
</article><!-- #post-## -->
<button type="button" id="new-quote-button">
    Show Me Another!
  </button>
