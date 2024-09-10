<?php
/*
Template Name: Homepage
*/
get_header();
?>

<!-- Content -->
<main id="primary" class="site-main">

    <section class="bubblesbgc">
        <h1>Développeur web <br>et<br> Webmaster</h1>
    </section>

    <section class="infosSkillsContainer">
        <div class="infosSkills">
                <div class="description"> <p>Bonjour, je m'appelle Maxime. En tant que développeur Web et Webmaster, je vous 
                    propose mes services pour vous créer des solutions numériques, ou vous accompagner dans les votres.</p><br>
                    <p class="strong">J'utilise, et peux vous accompagner sur les technologies et les aspects suivants (cliquez sur les perles pour plus de détails) :</p>
                </div>

            <div class="skills">

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="skill1 swiper-slide"  data-skilln="javascript">
                        <img class="skillop" src="<?= get_template_directory_uri() . '/assets/JSscallop.png' ?>" alt="Javascript icon inside a great scallop">
                        </div>
                        <div class="skill2 swiper-slide"  data-skilln="html">
                        <img class="skillop" src="<?= get_template_directory_uri() . '/assets/HTMLscallop.png' ?>" alt="HTML icon inside a great scallop">
                        </div>
                        <div class="skill3 swiper-slide"  data-skilln="php">
                        <img class="skillop" src="<?= get_template_directory_uri() . '/assets/PHPscallop.png' ?>" alt="PHP icon inside a great scallop">
                        </div>
                        <div class="skill4 swiper-slide"  data-skilln="greenit">
                        <img class="skillop" src="<?= get_template_directory_uri() . '/assets/GreenITscallop.png' ?>" alt="GreenIT icon inside a great scallop">
                        </div>
                        <div class="skill5 swiper-slide"  data-skilln="agile">
                            <img class="skillop" src="<?= get_template_directory_uri() . '/assets/Agilescallop.png' ?>" alt="Agile icon inside a great scallop">
                        </div>
                        <div class="skill6 swiper-slide"  data-skilln="css">
                            <img class="skillop" src="<?= get_template_directory_uri() . '/assets/CSSscallop.png' ?>" alt="CSS icon inside a great scallop">
                        </div>
                        <div class="skill7 swiper-slide"  data-skilln="sass">
                            <img class="skillop" src="<?= get_template_directory_uri() . '/assets/SASSscallop.png' ?>" alt="SASS icon inside a great scallop">
                        </div>
                        <div class="skill8 swiper-slide"  data-skilln="translation">
                            <img class="skillop" src="<?= get_template_directory_uri() . '/assets/Translationscallop.png' ?>" alt="Translation icon inside a great scallop">
                        </div>
                        <div class="skill9 swiper-slide"  data-skilln="seo">
                            <img class="skillop" src="<?= get_template_directory_uri() . '/assets/SEOscallop.png' ?>" alt="SEO icon inside a great scallop">
                        </div>
                        <div class="skill10 swiper-slide"  data-skilln="wordpress">
                            <img class="skillop" src="<?= get_template_directory_uri() . '/assets/WordpressScallop.png' ?>" alt="WordPress icon inside a great scallop">
                        </div>
                    </div>
                </div>
                <!-- Lightbox -->
                <div id="customLightbox" class="lightbox">
                    <div class="lightflex">
                        <div id="lightboxContent" class="lightboxContainer">
                            <span class="lightboxClose">&times;</span>
                            
                            <?php
                            // https://www.advancedcustomfields.com/resources/query-posts-custom-fields/
                            $skill_name = isset($_GET['skilln']) ? sanitize_text_field($_GET['skilln']) : '';
                            $args = [
                                'post_type' => 'scallop',
                                'posts_per_page' => 1,
                                'meta_key' => 'skillname',
                                'meta_value' => $skill_name,
                                'compare' => '=',
                            ];
                            
                            $scallop = new WP_Query($args);

                    if ($scallop->have_posts()) :
                        while ($scallop->have_posts()) : $scallop->the_post();
                            get_template_part('template-parts/styledScallop');
                        endwhile;

                            else :
                            echo '<p>Pas de contenu dans la perle, contenu à venir</p>';?>
                <?php endif; 
                wp_reset_postdata(); 
                ?>
                        </div>
                    </div>
                </div>
            </div>
            <p>En résumé : JS - PHP - HTML - CSS - SASS - Méthode Agile - SEO - Backend de Wordpress - Traduction de contenu en anglais - Green IT</p>
        </div>
    </section>

    <div class="projectsAndContact">
        <div id="particles-js"></div>

            <div class="pcContainer">
                <section class="projets">
                    <h2>Projets et travaux récents</h2>
                    <div class="projectGrid">

                        <!-- Grid with 6 elements -->
                        <div class="projectContainer flex1">
                            <h3>Koukaki</h3>
                            <a href="#">
                                <div class="parallaxeWrapper">
                                    <img class="rotateF" src="<?= get_template_directory_uri() . '/assets/AstronautKoukaki.png' ?>" alt="Astronaut floating and holding Koukaki's project on his laptop">
                                </div>
                            </a>
                        </div>
                        <div class="textProject flex2">
                            <p>Site de formation, demandant de programmer beaucoup d'animations visuelles.</p>
                        </div>
                        
                        <div class="textProject flex4">
                            <p>Site de formation, demandant une connaissance profonde des mécanismes du back end de WordPress pour
                                en exploiter les données.
                            </p>
                        </div>
                        <div class="projectContainer flex3">
                            <h3>Nathalie Mota</h3>
                            <a href="#">
                                <div class="parallaxeWrapper">
                                    <img class="rotateB" src="<?= get_template_directory_uri() . '/assets/AstronautMota.png' ?>" alt="Astronaut floating and holding Nathalie Mota's project on his laptop">
                                </div>
                            </a>
                        </div>

                        <div class="projectContainer flex5">
                            <h3>Fingerstyle</h3>
                            <a href="#">
                                <div class="parallaxeWrapper">
                                    <img class="rotateF" src="<?= get_template_directory_uri() . '/assets/AstronautMota.png' ?>" alt="Astronaut floating and holding Fingerstyle's project on his laptop">
                                </div>
                            </a>
                        </div>
                        <div class="textProject-padBTM flex6">
                            <p>Site réalisé dans le but de créer un espace communautaire autour du Fingerstyle, une pratique
                                musicale qui consiste à jouer sur des instruments à cordes uniquement avec les doigts, et réaliser des polyrythmies et autres
                                techniques avancées.
                            </p>
                        </div>

                    </div>
                    <button class="seeProjects">Voir tous les projets</button>
                </section>


                <section class="contact">
                    <div class="globeContainer">
                        <div id="globe-container"></div>
                    </div>
                    <div class="connect"></div>
                </section>
           </div>

    </div>

</main>

<?php
get_sidebar();
get_footer();
?>