<?php
/**
 * The template for displaying all pages.
 *
 * Template Name: Submit A Quote
 * @package QOD_Starter_Theme
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </header><!-- .entry-header -->
          <?php if (is_user_logged_in()) { ?>
          <div class="entry-content">
            <form method="POST" id="quoteSubmit" name="quoteSubmit" class="submit-form">
              <fieldset>
                <label>
                  Author of Quote
                </label>
                <input type="text" name="quoteAuthor" id="author">
                <label>
                  Quote
                </label>
                <textarea rows="4" cols="50" name="quote" id="quote"></textarea>
                <label>
                  Where did you find this quote? (e.g. book name)
                </label>
                <input type="text" name="quoteOrigin" id="origin">
                <label>
                  Provide the URL of the quote source, if available.
                </label>
                <input type="url" name="quoteURL" id="url">
                <button type="submit">Submit Quote</button>
              </fieldset>
            </form>
          </div><!-- .entry-content -->
        <?php } else { ?>
          <p>Sorry, you must be logged in to submit a quote!</p>
          <p>
            <a href="<?php echo esc_url( home_url( '/wp-login.php' ) ); ?>">Click here to login.</a>
          </p>
        <?php } ?>
        </article><!-- #post-## -->

      <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>