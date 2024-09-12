<?php
get_header();
?>

<!-- Content -->
<main id="primary" class="site-main">

<?php 

$currentPostURL = get_permalink();
$imageP = get_field('projectimage');
$titleP = get_field('projecttitle');
$descriptionP = get_field('projectdescription');

?>
<div class="projectsAndContacts">
    <div id="particles-js"></div>
        <div class="projectWrap" data-url="<?= esc_url($currentPostURL) ?>">
            <div class="imageWrap">
               <img src="<?php echo esc_url($imageP['url']); ?>" alt="<?php echo esc_attr($imageP['alt']); ?>" />
            </div>
            <div class="textPWrap">
              <h1><?= $titleP; ?></h1>
              <p><?= $descriptionP ?></p>
            </div>
    </div>
</div>
</main>

<?php
get_footer();
?>