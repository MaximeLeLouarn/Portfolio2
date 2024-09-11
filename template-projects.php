<?php
/*
Template Name: Projects
*/
get_header();
?>

<!-- Content -->
<main id="primary" class="site-main">

    <section class="bubblesbgc">
    <div class="filtersImages">
        
    <!-- Implement filters -->
    <div class="filters">

        <div class="catFor">
            <div class="projectTypeContainer">

                <button class="dropdownButton dropdownButtonTextCat" id="projectTypeButton">
                    Catégorie <span class="arrow" id="arrow">&#9660;</span>
                </button>

                <div class="dropdownContent">
                        <!-- To be able to come back to all photos without filter -->
                        <a href="#!" class="projectTypeFilter" data-projecttype="all">Tout</a>
                        <!-- And go fetch all the other possible options -->
                            <?php
                            $getSubProjectTypes = get_terms('projecttype');

                            if (!empty($getSubProjectTypes) && !is_wp_error($getSubProjectTypes)) {
                                foreach ($getSubProjectTypes as $getSubProjectType) {
                                    echo '<a href="#" class="projectTypeFilter" data-projecttype="' . esc_attr($getSubProjectType->slug) . '">' . esc_html($getSubProjectType->name) . '</a>';
                                }
                            }
                            ?>
                </div>

            </div>

    <div class="imagesAndLoad">
                
            <div class="mockUps">
    
                <?php 
    
                    // Get all term slugs for the 'categorie' taxonomy
                    $termsCArray = get_all_term_slugs('projecttype');
    
                    // Debug output
                    // print_r($termsCArray);
    
    
    
                    $postsPerPage = 1;
                    $projects = new WP_Query([
                        'post_type'      => 'project',
                        'posts_per_page' => $postsPerPage,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'paged'          => 1,
                        'tax_query'      => [
                            [
                                'taxonomy' => 'projecttype',
                                'field'    => 'slug',
                                'terms'    => $termsCArray, // This array can contain multiple slugs
                                'operator' => 'IN' // This checks for posts in any of the given terms
                            ]
                        ]
                    ]);
                    
                    
                    // If it doesn't work, let's try different structure where we can endwhile after get_template_part and reset after endif.
                    // Tutorial followed at this link: https://weichie.com/blog/load-more-posts-ajax-wordpress/.
                    // The position of the div is important in this way, or it will keep displaying many divs
                    if ($projects->have_posts()) : ?>
                        <div class="publicationList"><?php
                        while ($projects->have_posts()) : $projects->the_post(); ?>
                                <?php get_template_part('template-parts/BlockPhoto');
                                
                                endwhile; 
                                // Try to debug and understand what could cause no post to appear on page load
                                ?></div><?php
                                else :
                                echo '<p>Projets en cours de construction</p>';?>
                    <?php endif; 
                    wp_reset_postdata(); 
                    ?>
                
            </div>
    
    
            <div class="loadMoreContainer">
                <a href="#!" class="" id="loadMore">Charger plus</a>
            </div>
    
        </div>


    </div>
    </section>

    </main>

<?php
get_sidebar();
get_footer();
?>