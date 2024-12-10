<?php
/**
 * Essence Pro.
 *
 * Homepage content optionally installed after theme activation.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

return <<<CONTENT
<!-- wp:genesis-blocks/gb-post-grid {"className":"margin-overlay","postsToShow":2,"postTitleTag":"h2","align":"full","excerptLength":16,"imageSize":"featured-image"} /-->

<!-- wp:genesis-blocks/gb-post-grid {"postsToShow":3,"displayPostDate":false,"displayPostExcerpt":false,"displayPostAuthor":false,"displayPostLink":false,"postTitleTag":"h2","columns":3,"align":"full","offset":2,"imageSize":"featured-image"} /-->

<!-- wp:genesis-blocks/gb-container {"containerWidth":"full"} -->
<div class="wp-block-genesis-blocks-gb-container gb-block-container alignfull"><div class="gb-container-inside"><div class="gb-container-content"><!-- wp:buttons {"contentJustification":"center","className":"is-style-divider-button"} -->
<div class="wp-block-buttons is-content-justification-center is-style-divider-button"><!-- wp:button {"style":{"color":{"text":"#777777"}},"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color" href="#" style="color:#777777">Read More Posts</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-container {"containerPaddingTop":10,"containerPaddingRight":20,"containerPaddingBottom":15,"containerPaddingLeft":20,"containerMarginTop":12,"containerMarginBottom":10,"containerWidth":"full","containerBackgroundColor":"#ffffff","className":"box-shadow"} -->
<div style="background-color:#ffffff;padding-left:20%;padding-right:20%;padding-bottom:15%;padding-top:10%;margin-top:12%;margin-bottom:10%" class="wp-block-genesis-blocks-gb-container box-shadow gb-block-container alignfull"><div class="gb-container-inside"><div class="gb-container-content" style="max-width:1600px"><!-- wp:heading {"align":"center"} -->
<h2 style="text-align:center" id="newsletter">Join Our Weekly Newsletter </h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p style="text-align:center">Get our best articles about body, mind, soul, style, travel, and culture. No charge. No spam. Only love. </p>
<!-- /wp:paragraph -->

<!-- wp:genesis-blocks/gb-newsletter {"buttonShape":"gb-button-shape-square","mailingList":"1a951fe674","customBackgroundColor":"#ffffff","instanceId":0,"className":"inline-submit"} /--></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->
CONTENT;
