<?php
// Access the 'skill' parameter passed through the template part
    // Retrieving custom fields
    $imageSC = get_field('imagesc');
    $techIcon = get_field('techicon');
    $techDescription = get_field('techdescription'); 
    $currentPostURL = get_permalink();?>

<div class="imgsSkills" data-url="<?= esc_url($currentPostURL); ?>">
    <div class="scallop-content">
        <?php if ($imageSC): ?>
            <div class="image-wrap">
                <img src="<?php echo esc_url($imageSC['url']); ?>" alt="<?php echo esc_attr($imageSC['alt']); ?>" />
            </div>
        <?php endif; ?>
        
        <?php if ($techIcon): ?>
            <div class="image-wrap">
                <img src="<?php echo esc_url($techIcon['url']); ?>" alt="<?php echo esc_attr($techIcon['alt']); ?>" />
            </div>
        <?php endif; ?>
    </div>
        <?php if ($techDescription): ?>
            <div class="text-wrap">
                <p><?php echo esc_html($techDescription); ?></p>
            </div>
        <?php endif; ?>
</div>