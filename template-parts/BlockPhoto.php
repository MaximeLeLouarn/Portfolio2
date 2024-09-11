<div class="photosPostsContainer" id="photosPostsContainer">
<?php

    $currentPostId = get_the_ID();
    $currentPostTitle = get_the_title();
    $currentPostImage = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $currentPostAltText = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
    $currentPostURL = get_permalink();

    // Retrieve cat slug
    $currentPostC = wp_get_post_terms($currentPostId, 'projecttype');
    $currentPostCatSlugs = array();
    if (!is_wp_error($currentPostC)) {
        foreach ($currentPostC as $term) {
            $currentPostCatSlugs[] = $term->slug;
        }
    }
    $currentPostCat = implode(',', $currentPostCatSlugs);
?>

    <div class="postMockup" data-projecttype="<?= $currentPostCat; ?>" data-url="<?= esc_url($currentPostURL); ?>" >

        <a href="<?= esc_url($currentPostURL); ?>">
            <img class="imgPostItem" src="<?= $currentPostImage ?>" alt="<?= $currentPostAltText ?>">
        </a>

    </div>
    
</div>