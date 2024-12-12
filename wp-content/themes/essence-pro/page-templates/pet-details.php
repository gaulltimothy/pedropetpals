<?php
/* Template Name: Pet Details */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

// Load required WordPress media functions
if ( ! function_exists( 'media_sideload_image' ) ) {
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
}

// Get the animal ID from the query string
$animal_id = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : null;

if ( ! $animal_id ) {
    error_log( 'No animal ID provided.' );
    echo '<p>No animal ID provided.</p>';
    get_footer();
    exit;
}

// Fetch cached animals
$animals = get_cached_animals();

if ( empty( $animals ) ) {
    error_log( 'No animals available in the cache.' );
    echo '<p>No animals available in the cache.</p>';
    get_footer();
    exit;
}

// Find the animal by ID
$animal = null;
foreach ( $animals as $item ) {
    if ( $item['id'] == $animal_id ) {
        $animal = $item;
        break;
    }
}

if ( ! $animal ) {
    error_log( 'Animal not found for ID: ' . $animal_id );
    echo '<p>Animal not found for the given ID.</p>';
    get_footer();
    exit;
}

// Set the primary image as the featured image
if ( ! empty( $animal['photos'][0]['large'] ) ) {
    $primary_image_url = $animal['photos'][0]['large'];

    if ( ! has_post_thumbnail() ) {
        $upload_id = media_sideload_image( $primary_image_url, get_the_ID(), null, 'id' );
        if ( is_wp_error( $upload_id ) ) {
            error_log( 'Error setting featured image: ' . $upload_id->get_error_message() );
        } else {
            set_post_thumbnail( get_the_ID(), $upload_id );
            error_log( 'Featured image set for post ID: ' . get_the_ID() );
        }
    }
}
?>
<section id="pet-<?php echo esc_attr( $animal['id'] ); ?>" class="gb-block-post-grid alignfull">
    <div class="gb-post-grid-items is-grid columns-2">
        <div class="gb-post-grid-item slideshow-and-cta">
            <?php if ( ! empty( $animal['photos'] ) ) : ?>
                <div class="slideshow-container">
                    <?php foreach ( $animal['photos'] as $photo ) : ?>
                        <div class="slide" style="background-image: url('<?php echo esc_url( $photo['large'] ); ?>');"></div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>No images available for this pet.</p>
            <?php endif; ?>
            <div class="petDetailsCtaLinks">
                <div class="woocommerce-link">
                    <?php if ( isset( $animal['woocommerce_product_id'] ) ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $animal['woocommerce_product_id'] ) ); ?>" class="button adopt-now">
                            View More / Adopt
                        </a>
                    <?php else : ?>
                        <p>No adoption details available at this time.</p>
                    <?php endif; ?>
                </div>
                <div class="petfinder-link">
                    <a href="<?php echo esc_url( $animal['url'] ); ?>" target="_blank" class="cta-button">
                        View <?php echo esc_html( $animal['name'] ); ?> on Petfinder
                    </a>
                </div>
            </div>
        </div>
        <div class="gb-post-grid-item animal-details">
            <header class="gb-block-post-grid-header">
                <h2 class="gb-block-post-grid-title"><?php echo esc_html( $animal['name'] ); ?></h2>
            </header>
            <ul class="petDetailsExcerpt">
                <li><strong>Breed:</strong> <?php echo esc_html( $animal['breeds']['primary'] ?? 'Unknown' ); ?></li>
            </ul>
        </div>
    </div>
</section>
<?php get_footer(); ?>
