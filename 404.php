<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package portfolioMax
 */

get_header();
?>

	<main id="primary" class="site-main">

	<section class="bubblesbgc">
		<div class="errorContainer">
			<div class="textContainer">
				<h1>ERREUR 404</h1>
				<p>Vous avez été redirigé vers un lien mort. Mais ne vous inquiétez pas, 
					nous travaillons dessus.
				</p>
			</div>
			<div class="imgContainer">
				<img src="<?= get_template_directory_uri() . '/assets/errorCrab.png' ?>" alt="A giant red crab, here to fix bugs">
			</div>
		</div>
	</section>

	</main><!-- #main -->

<?php
get_footer();
