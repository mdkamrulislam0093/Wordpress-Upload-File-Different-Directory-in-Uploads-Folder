<?php
    if ( isset($_FILES['profile_picture']) ) {

        $tmp_name = $_FILES['profile_picture']['tmp_name'];

        $content = file_get_contents( $tmp_name );

        $_filter = true;
        add_filter( 'upload_dir', function( $arr ) use( &$_filter ){
            if ( $_filter ) {
                $folder = '/WPL/users/'; 

                $arr['path'] = $arr['basedir'] . $folder;
                $arr['url'] = $arr['baseurl'] . $folder;
                $arr['subdir'] = $folder;   
            }
            return $arr;
        });


        $upload_dir = wp_upload_dir();
        $user_upload_dir = $upload_dir['basedir'] . '/WPL/users/thprofile_60x60.png';

        if (file_exists($user_upload_dir)) {
            wp_delete_file($user_upload_dir);
        }

        $update_res['profile'] = wp_upload_bits( 'thprofile_60x60.png', null, $content );
        $_filter = false;
    }
?>
