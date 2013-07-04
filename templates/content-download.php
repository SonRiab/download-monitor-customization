<?php
/**
* Detailed download output
*/

global $dlm_download;
?>
<section class="download-paul">

    <?php $dlm_download->the_image(); ?>

    <div class="download-paul-content">

        <h3>
            <?php $dlm_download->the_title(); ?>
        </h3>
        
        <small>
            <?php 
            $terms = wp_get_post_terms( $dlm_download->id, 'dlm_download_category' );
            foreach($terms as $term) {
                printf( '%s ', $term->name ); 
            }
            ?> &ndash;
            <?php 
            if ( $dlm_download->has_version_number() ) {
                printf( __( 'Version %s &ndash;', 'download_monitor' ), $dlm_download->get_the_version_number() );
            } 
            ?>
            <a id="link-<?php printf("%u", $dlm_download->id); ?>" class="paul-dm-toggle">Details</a> &ndash;
            <?php printf( _n( '1 download', '%d downloads', $dlm_download->get_the_download_count(), 'download_monitor' ), $dlm_download->get_the_download_count() ) ?> 
        </small>
        
    </div>
    
    <div class="download-paul-button">
        <a class="download-button" title="<?php $dlm_download->the_filename(); ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
            <?php _e( 'Download File', 'download_monitor' ); ?>
            
            <small><?php $dlm_download->the_filetype(); ?> &ndash; <?php $dlm_download->the_filesize(); ?></small>
            
        </a>
    </div>
    
    <div id="details-<?php printf("%u", $dlm_download->id); ?>" class="download-paul-details">
        <?php printf('%s', wpautop( $dlm_download->post->post_content ) ); ?>
        <?php 
        $meta = get_post_meta( $dlm_download->id );
        foreach($meta as $key=>$value) {
            // filter all meta keys starting with an '_'
            if( !empty( $value ) && strncmp( $key, '_', 1 ) )
                printf( '<strong>%s:</strong> %s', $key, $value[0] ); 
        }
        ?>
    </div>

</section>
