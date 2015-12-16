<?php

final class NF_GoDaddy_ObjectCaching
{
    public function __construct()
    {
        $this->maybe_enable_disable();

        add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
    }

    public function add_submenu_page()
    {
        $parent_slug = 'tools.php';
        $page_title  = 'Ninja Forms - GoDaddy Object Caching';
        $menu_title  = 'Ninja Forms - GoDaddy Object Caching';
        $capability  = 'manage_options';
        $menu_slug   = 'nf-godaddy-object-caching';
        $function    = array( $this, 'submenu_page' );

        add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    }

    public function submenu_page()
    {
        $url_enable  = add_query_arg( array(
            'page' => 'nf-godaddy-object-caching',
            'nf-godaddy-object-cache-enable' => '1'
        ), admin_url( 'tools.php' ) );

        $url_disable = add_query_arg( array(
            'page' => 'nf-godaddy-object-caching',
            'nf-godaddy-object-cache-disable' => '1'
        ), admin_url( 'tools.php' ) );
        ?>

        <h2>Ninja Forms - GoDaddy Object Caching</h2>

        <div class="wrap">

            <a href="<?php echo $url_enable; ?>" class="button button-primary" >Enable</a>
            <a href="<?php echo $url_disable; ?>" class="button button-secondary" >Disable</a>

        </div>

        <?php
    }

    public function admin_notice_disable_success()
    {
        $class = "updated";
        $message = "GoDaddy Object Caching Disabled.";
        echo"<div class=\"$class\"> <p>$message</p></div>";
    }

    public function admin_notice_enable_success()
    {
        $class = "updated";
        $message = "GoDaddy Object Caching Enabled.";
        echo"<div class=\"$class\"> <p>$message</p></div>";
    }


    /*
     * GoDaddy Object Caching
     */
    private function maybe_enable_disable()
    {
        if( ! defined( 'WP_CONTENT_DIR' ) ) return;

        /*
         * DISABLE GoDaddy Object Caching
         */
        if ( isset( $_GET[ 'nf-godaddy-object-cache-disable' ] ) && file_exists( WP_CONTENT_DIR . '/object-cache.php' ) ) {

            rename( WP_CONTENT_DIR . '/object-cache.php', WP_CONTENT_DIR . '/object-cache-disabled.php' );

            if( file_exists( WP_CONTENT_DIR . '/object-cache-disabled.php' ) ){

                add_action( 'admin_notices', array( $this, 'admin_notice_disable_success' ) );
            }
        }

        /*
         * ENABLE GoDaddy Object Caching
         */
        if ( isset( $_GET[ 'nf-godaddy-object-cache-enable' ] ) && file_exists( WP_CONTENT_DIR . '/object-cache-disabled.php' ) ) {

            rename( WP_CONTENT_DIR . '/object-cache-disabled.php', WP_CONTENT_DIR . '/object-cache.php' );

            if( file_exists( WP_CONTENT_DIR . '/object-cache.php' ) ){

                add_action( 'admin_notices', array( $this, 'admin_notice_enable_success' ) );
            }
        }
    }
}

(new NF_GoDaddy_ObjectCaching);