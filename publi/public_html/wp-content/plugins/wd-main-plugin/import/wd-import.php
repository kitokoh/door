<?php
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
/**
 * Register styles and scripts
 */

function doors_admin_scripts_init() {

    wp_register_script('bootstrap.min', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-tabs', 'jquery-ui-droppable', 'jquery-ui-sortable' ) , false , false );

}
add_action('admin_init', 'doors_admin_scripts_init');


class doors_Import {

    public $message = "";
    public $attachments = false;


    function init_doors_import() {
        if(isset($_REQUEST['import_option'])) {
            $import_option = $_REQUEST['import_option'];
            if($import_option == 'content'){
            }elseif($import_option == 'custom_sidebars') {
                $this->import_custom_sidebars('custom_sidebars.txt');
            } elseif($import_option == 'widgets') {
                $this->import_widgets('widgets.txt');
            } elseif($import_option == 'options'){
                $this->import_options('options.txt');
            }elseif($import_option == 'menus'){
                $this->import_menus('menus.txt');
            }elseif($import_option == 'settingpages'){
                $this->import_settings_pages('settingpages.txt');
            }elseif($import_option == 'complete_content'){
                $this->import_options('options.txt');
                $this->import_widgets('widgets.txt');
                $this->import_menus('menus.txt');
                $this->import_settings_pages('settingpages.txt');
                $this->message = esc_html__("Content imported successfully", "doors");
            }
        }
    }

    public function doors_import_content($file){
        ob_start();
        if (!class_exists('WP_Importer')) {
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            require_once($class_wp_importer);
        }
        if (!class_exists('WP_Import')) {
            require_once(plugin_dir_path( __FILE__ ) . '/class.wordpress-importer.php');
        }
        $doors_import = new WP_Import();
        set_time_limit(0);
        $path = plugin_dir_path( __FILE__ ) . '/files/' . $file;
        if(!file_exists($path)) {
            echo 'error';
            wp_send_json_error(esc_html__("Content file not found", "doors"));
        }

        print $path;
        $doors_import->fetch_attachments = $this->attachments;
        $returned_value = $doors_import->import($path);
        if(is_wp_error($returned_value)){
            $this->message = esc_html__("An Error Occurred During Import", "doors");
            echo 'error';
            wp_send_json_error(esc_html__("An Error Occurred During Content Import", "doors"));
        }
        else {
            $this->message = esc_html__("Content imported successfully", "doors");
        }
        ob_get_clean();
    }

    public function doors_available_widgets() {

        global $wp_registered_widget_controls;

        $widget_controls = $wp_registered_widget_controls;

        $available_widgets = array();

        foreach ( $widget_controls as $widget ) {

            if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name'] = $widget['name'];

            }

        }

        return apply_filters( 'wie_available_widgets', $available_widgets );

    }

    public function import_widgets($file){

        if(!file_exists(dirname(__FILE__) . $file)) {
            echo 'error';
            wp_send_json_error(esc_html__("Widgets file not found", "doors"));
        } else {
            $myfile = fopen( dirname(__FILE__) . $file, "r" ) or wp_die( "Unable to open file!" );
            $data = fread( $myfile, filesize( dirname(__FILE__) . $file ) );
            fclose( $myfile );
        }

        /*
        $data = file_get_contents( "./demo-files/widgets.txt", FILE_USE_INCLUDE_PATH );
        $data = json_decode( $data );

        // Delete import file
        unlink( $file );*/

        $data = json_decode( $data );



        global $wp_registered_sidebars;

        // Have valid data?
        // If no data or could not decode
        if ( empty( $data ) || ! is_object( $data ) ) {
            echo 'error';
            wp_send_json_error(esc_html__( "Widgets import data file could not be read or is empty.", "doors" ));
            wp_die(
                __( 'Import data could not be read. Please try a different file.', "doors" ),
                '',
                array( 'back_link' => true )
            );
        }

        // Hook before import
        do_action( 'wie_before_import' );
        $data = apply_filters( 'import_widgets', $data );

        // Get all available widgets site supports
        $available_widgets = $this->doors_available_widgets();

        // Get all existing widget instances
        $widget_instances = array();
        foreach ( $available_widgets as $widget_data ) {
            $widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
        }

        // Begin results
        $results = array();

        // Loop import data's sidebars
        foreach ( $data as $sidebar_id => $widgets ) {

            // Skip inactive widgets
            // (should not be in export file)
            if ( 'wp_inactive_widgets' == $sidebar_id ) {
                continue;
            }

            // Check if sidebar is available on this site
            // Otherwise add widgets to inactive, and say so
            if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
                $sidebar_available = true;
                $use_sidebar_id = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message = '';
            } else {
                $sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                $sidebar_message_type = 'error';
                $sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', "doors" );
            }

            // Result for sidebar
            $results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message'] = $sidebar_message;
            $results[$sidebar_id]['widgets'] = array();

            // Loop widgets
            foreach ( $widgets as $widget_instance_id => $widget ) {

                echo $sidebar_id .' - '. $widget_instance_id;

                $fail = false;

                // Get id_base (remove -# from end) and instance ID number
                $id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
                $instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

                // Does site support this widget?
                if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
                    $fail = true;
                    $widget_message_type = 'error';
                    $widget_message = __( 'Site does not support widget', "doors" ); // explain why widget not imported
                }

                // Filter to modify settings object before conversion to array and import
                // Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
                // Ideally the newer wie_widget_settings_array below will be used instead of this
                $widget = apply_filters( 'wie_widget_settings', $widget ); // object

                // Convert multidimensional objects to multidimensional arrays
                // Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
                // Without this, they are imported as objects and cause fatal error on Widgets page
                // If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
                // It is probably much more likely that arrays are used than objects, however
                $widget = json_decode( json_encode( $widget ), true );

                // Filter to modify settings array
                // This is preferred over the older wie_widget_settings filter above
                // Do before identical check because changes may make it identical to end result (such as URL replacements)
                $widget = apply_filters( 'wie_widget_settings_array', $widget );

                // Does widget with identical settings already exist in same sidebar?
                if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

                    // Get existing widgets in this sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' );
                    $sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

                    // Loop widgets with ID base
                    $single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
                    foreach ( $single_widget_instances as $check_id => $check_widget ) {

                        // Is widget in same sidebar and has identical settings?
                        if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

                            $fail = true;
                            $widget_message_type = 'warning';
                            $widget_message = __( 'Widget already exists', "doors" ); // explain why widget not imported

                            break;

                        }

                    }

                }

                // No failure
                if ( ! $fail ) {

                    // Add widget instance
                    $single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
                    $single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
                    $single_widget_instances[] = $widget; // add it

                    // Get the key it was given
                    end( $single_widget_instances );
                    $new_instance_id_number = key( $single_widget_instances );

                    // If key is 0, make it 1
                    // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                    if ( '0' === strval( $new_instance_id_number ) ) {
                        $new_instance_id_number = 1;
                        $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                        unset( $single_widget_instances[0] );
                    }

                    // Move _multiwidget to end of array for uniformity
                    if ( isset( $single_widget_instances['_multiwidget'] ) ) {
                        $multiwidget = $single_widget_instances['_multiwidget'];
                        unset( $single_widget_instances['_multiwidget'] );
                        $single_widget_instances['_multiwidget'] = $multiwidget;
                    }

                    // Update option with new widget
                    update_option( 'widget_' . $id_base, $single_widget_instances );

                    // Assign widget instance to sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
                    $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
                    update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

                    // Success message
                    if ( $sidebar_available ) {
                        $widget_message_type = 'success';
                        $widget_message = __( 'Imported', "doors" );
                    } else {
                        $widget_message_type = 'warning';
                        $widget_message = __( 'Imported to Inactive', "doors" );
                    }

                }

                // Result for widget instance
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget['title'] ) ? $widget['title'] : __( 'No Title', "doors" ); // show "No Title" if widget instance is untitled
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

            }

        }
    }


    public function import_options($file){
        $options = $this->file_options($file,'Options');
        update_option( 'doors_options_array', $options);
        $this->message = esc_html__("Options imported successfully", "doors");
    }

    public function import_menus($file){
        global $wpdb;
        $doors_terms_table = $wpdb->prefix . "terms";
        $doors_terms_table = esc_sql( $doors_terms_table );
        $this->menus_data = $this->file_options($file,'Menus');

        $locations = get_theme_mod('nav_menu_locations');
        $menuname = 'main-menu';
        $menu_exists = wp_get_nav_menu_object( $menuname );
        $menu_id = $menu_exists->term_id;
        $locations['primary'] = $menu_id;
        $menuname = 'right-menu';
        $menu_exists = wp_get_nav_menu_object( $menuname );
        $menu_id = $menu_exists->term_id;
        $locations['right-menu'] = $menu_id;
        $menuname = 'button-menu';
        $menu_exists = wp_get_nav_menu_object( $menuname );
        $menu_id = $menu_exists->term_id;
        $locations['menu_button'] = $menu_id;

        set_theme_mod( 'nav_menu_locations', $locations );



    }
    public function import_settings_pages($file){
        $pages = $this->file_options($file,'Settings');

        foreach($pages as $doors_page_option => $doors_page_id){
            update_option( $doors_page_option, $doors_page_id);
        }

        $demo = 'demo-1';
        if (!empty($_POST['example']))
          $demo = $_POST['example'];

          switch($demo){
            case 'demo-1': $page = 'Home';
              break;
            case 'demo-2': $page = 'Home';
              break;
            case 'demo-3': $page = 'Home';
              break;
          }
 
        $home_page = get_option("page_on_front");
        if(!$home_page || !is_page($home_page)) { 
            $home = get_page_by_title($page, OBJECT, 'page');
            update_option('page_on_front',$home->ID);
        }
        $blog_page = get_option("page_for_posts");
        if(!$blog_page || !is_page($blog_page)) {
            $blog = get_page_by_title('Blog');
            update_option('page_for_posts',$blog->ID);
        }
    }
    public function file_options($file,$text){
        $file_content = "";
        $file_for_import = plugin_dir_path( __FILE__ ) . '/files/' . $file;
        if ( file_exists($file_for_import) ) {
            $file_content = $this->doors_file_contents($file_for_import);
        } else {
            $this->message = esc_html__("File doesn't exist", "doors");
            echo 'error';
            wp_send_json_error(esc_html__($text." file doesn't exist", "doors"));
        }
        if ($file_content) {
            $unserialized_content = unserialize($file_content);
            $json_array = json_decode($file_content);
            /*print_r($json_array);*/
            if (is_array($unserialized_content)) {
                if($text=='Options'){
                    echo 'error';
                    wp_send_json_error('Unserialized');
                }

            }
            // print_r($json_array);
            return $unserialized_content;
        }  else{
            echo 'error';
            wp_send_json_error(esc_html__( $text." import data file could not be read or is empty.", "doors" ));
        }
        /*return false;*/
    }

    function doors_file_contents( $path ) {
        $doors_content = '';
        if ( function_exists('realpath') )
            $filepath = realpath($path);
        if ( !$filepath || !@is_file($filepath) ) {
            echo 'error';
            wp_send_json_error(esc_html__("File doesn't exist or not valid", "doors"));
            return '';
        }
        if( ini_get('allow_url_fopen') ) {
            $doors_file_method = 'fopen';
        } else {
            $doors_file_method = 'file_get_contents';
        }
        if ( $doors_file_method == 'fopen' ) {
            $doors_handle = fopen( $filepath, 'rb' );

            if( $doors_handle !== false ) {
                while (!feof($doors_handle)) {
                    $doors_content .= fread($doors_handle, 8192);
                }
                fclose( $doors_handle );
            }
            return $doors_content;
        } else {
            return file_get_contents($filepath);
        }
    }
}
global $my_doors_Import;
$my_doors_Import = new doors_Import();



if(!function_exists('doors_dataImport'))
{
    function doors_dataImport()
    {
        global $my_doors_Import;

        if ($_POST['import_attachments'] == 1)
            $my_doors_Import->attachments = true;
        else
            $my_doors_Import->attachments = false;

        $folder = "files/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_doors_Import->doors_import_content($folder.$_POST['xml']);

        wp_die();
    }

    add_action('wp_ajax_doors_dataImport', 'doors_dataImport');
}


if(!function_exists('doors_menuImport'))
{
    function doors_menuImport()
    {
        global $my_doors_Import;

        if ($_POST['delete_menus'] == 1){
            delete_nav_menus();
        }

        if ($_POST['import_attachments'] == 1)
            $my_doors_Import->attachments = true;
        else
            $my_doors_Import->attachments = false;

        $folder = "files/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_doors_Import->doors_import_content($folder.'menus.xml');


        $locations = get_theme_mod('nav_menu_locations');
        $menuname = 'main-menu';
        $menu_exists = wp_get_nav_menu_object( $menuname );
        $menu_id = $menu_exists->term_id;
        $locations['primary'] = $menu_id;
        $menuname = 'right-menu';
        $menu_exists = wp_get_nav_menu_object( $menuname );
        $menu_id = $menu_exists->term_id;
        $locations['right-menu'] = $menu_id;
        $menuname = 'button-menu';
        $menu_exists = wp_get_nav_menu_object( $menuname );
        $menu_id = $menu_exists->term_id;
        $locations['menu_button'] = $menu_id;

        set_theme_mod( 'nav_menu_locations', $locations );
        wp_die();
    }

    add_action('wp_ajax_doors_menuImport', 'doors_menuImport');
}

if(!function_exists('doors_widgetsImport'))
{
    function doors_widgetsImport()
    {
        global $my_doors_Import;

        $folder = "/files/";
        if (!empty($_POST['example']))
            $folder .= $_POST['example']."/";

        $my_doors_Import->import_widgets($folder.'widgets.txt');

        wp_die();
    }

    add_action('wp_ajax_doors_widgetsImport', 'doors_widgetsImport');
}

if(!function_exists('doors_optionsImport'))
{
    function doors_optionsImport()
    {
        global $my_doors_Import;

        $folder = "/files/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_doors_Import->import_options($folder.'options.txt');

        wp_die();
    }

    add_action('wp_ajax_doors_optionsImport', 'doors_optionsImport');
}

if(!function_exists('doors_otherImport'))
{
    function doors_otherImport()
    {
        global $my_doors_Import;

        $folder = "/files/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        // $my_doors_Import->import_options($folder.'options.txt');
        // $my_doors_Import->import_widgets($folder.'widgets.txt');
        // $my_doors_Import->import_menus($folder.'menu.txt');
        $my_doors_Import->import_settings_pages($folder.'settingpages.txt');

        wp_die();
    }

    add_action('wp_ajax_doors_otherImport', 'doors_otherImport');
}

if (!function_exists('doors_import_options')) {
    function doors_import_options()
    {

        if (!empty($_POST['example'])) {
            $demo_name = $_POST['example'];
        }

        if ($demo_name == 'demo-1') {
            $file =  'a:70:{s:15:"doors_show_logo";s:1:"1";s:15:"doors_show_cart";s:1:"1";s:26:"doors_show_top_social_bare";s:0:"";s:17:"doors_box_wrapper";s:2:"of";s:18:"doors_menu_in_grid";s:0:"";s:17:"doors_menu_sticky";s:0:"";s:16:"doors_show_title";s:3:"off";s:21:"doors_footer_bg_image";s:82:"http://themes.webdevia.com/windows-doors/wp-content/uploads/2014/08/footer-bg-.jpg";s:15:"footer_bg_color";s:0:"";s:17:"footer_text_color";s:0:"";s:15:"doors_copyright";s:44:"© 2020 Windows & Doors All rights reserved.";s:15:"doors_poweredby";s:15:"Windows & Doors";s:20:"copyright_text_color";s:0:"";s:10:"doors_logo";s:77:"http://themes.webdevia.com/windows-doors/wp-content/uploads/2014/08/logo2.png";s:14:"doors_404_page";s:0:"";s:15:"doors_home_page";s:0:"";s:13:"doors_favicon";s:0:"";s:22:"doors_theme_custom_css";s:5:"light";s:16:"wrapper_bg_color";s:0:"";s:13:"primary_color";s:7:"#265fb4";s:15:"secondary_color";s:0:"";s:16:"adress_bar_color";s:0:"";s:16:"social_bar_color";s:0:"";s:12:"copyright_bg";s:7:"#0c162b";s:9:"header_bg";s:0:"";s:12:"container_bg";s:0:"";s:20:"doors_footer_columns";s:12:"four_columns";s:21:"navigation_text_color";s:0:"";s:26:"navigation_bg_color_sticky";s:0:"";s:18:"language_area_html";s:0:"";s:22:"doors_show_wpml_widget";s:0:"";s:7:"twitter";s:0:"";s:8:"facebook";s:0:"";s:6:"flickr";s:0:"";s:5:"vimeo";s:0:"";s:5:"phone";s:12:"458-362-1258";s:6:"adress";s:14:"547, San Diego";s:23:"doors_body_font_familly";s:4:"Lato";s:21:"doors_body_font_style";s:6:"normal";s:23:"doors_font-weight-style";s:0:"";s:30:"doors_main_text_lettre_spacing";s:0:"";s:28:"doors_main-text-font-subsets";s:9:"latin-ext";s:23:"doors_head_font_familly";s:14:"Archivo Narrow";s:21:"doors_head_font_style";s:6:"normal";s:31:"doors_heading-font-weight-style";s:3:"700";s:31:"doors_heading-text-font-subsets";s:9:"latin-ext";s:33:"doors_heading_text_lettre_spacing";s:0:"";s:29:"doors_navigation_font_familly";s:14:"Archivo Narrow";s:27:"doors_navigation_font_style";s:6:"normal";s:34:"doors_navigation-font-weight-style";s:3:"400";s:34:"doors_navigation-text-font-subsets";s:9:"latin-ext";s:36:"doors_navigation_text_lettre_spacing";s:0:"";s:16:"doors_menu_style";s:9:"corporate";s:21:"doors_theme_custom_js";s:0:"";s:20:"doors_call_to_action";s:0:"";s:18:"adress_bar_bgcolor";s:0:"";s:6:"button";s:15:"Request a Quote";s:4:"work";s:29:"Office Hour: 09:00am - 4:00pm";s:22:"doors_body_font_weight";s:3:"400";s:27:"doors_body_font_weight_list";s:7:"400,700";s:20:"doors_body_font_size";s:4:"15px";s:20:"doors_head_font_size";s:4:"12px";s:36:"doors_heading-font-weight-style-list";s:7:"400,700";s:26:"doors_navigation_font_size";s:4:"12px";s:39:"doors_navigation-font-weight-style-list";s:7:"400,700";s:19:"doors_blog_bg_image";s:0:"";s:17:"doors_button_link";s:0:"";s:17:"doors_search_icon";s:1:"1";s:24:"doors_language_area_html";s:5120:"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                &lt;div id=&quot;lang_sel_list&quot; class=&quot;lang_sel_list_horizontal right&quot;&gt;
    &lt;div id=&quot;lang_sel&quot;&gt;
        &lt;ul&gt;
            &lt;li&gt;
                &lt;a class=&quot;lang_sel_sel icl-en&quot; href=&quot;#&quot;&gt;
                            &lt;img title=&quot;English&quot; alt=&quot;rn&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png&quot; class=&quot;iclflag&quot;&gt; &lt;span class=&quot;icl_lang_sel_native&quot;&gt;English&lt;/span&gt; &lt;span class=&quot;icl_lang_sel_translated&quot;&gt;&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;(&lt;/span&gt;French&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;)&lt;/span&gt;&lt;/span&gt;&lt;/a&gt;
                &lt;ul&gt;
                    &lt;li class=&quot;icl-fr&quot;&gt;
                        &lt;a href=&quot;#&quot;&gt;                          
                       &lt;img title=&quot;French &quot; alt=&quot;fr&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/fr.png&quot; class=&quot;iclflag&quot;&gt; &lt;span class=&quot;icl_lang_sel_current icl_lang_sel_native&quot;&gt;French &lt;/span&gt;
                        &lt;/a&gt;
                    &lt;/li&gt;
                    &lt;li class=&quot;icl-es&quot;&gt;
                        &lt;a href=&quot;#&quot;&gt;
                            &lt;img title=&quot;Spanish&quot; alt=&quot;es&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/es.png&quot; class=&quot;iclflag&quot;&gt;  
                            &lt;span class=&quot;icl_lang_sel_native&quot;&gt;Spanish&lt;/span&gt;
                            &lt;span class=&quot;icl_lang_sel_translated&quot;&gt;&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;(&lt;/span&gt;
                            &lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;)&lt;/span&gt;&lt;/span&gt;
                        &lt;/a&gt;
                    &lt;/li&gt;
                &lt;/ul&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ";s:15:"doors_row_width";s:7:"default";}';
         }elseif ($demo_name == 'demo-2') {
            $file =  'a:70:{s:15:"doors_show_logo";s:1:"1";s:15:"doors_show_cart";s:1:"1";s:26:"doors_show_top_social_bare";s:0:"";s:17:"doors_box_wrapper";s:2:"of";s:18:"doors_menu_in_grid";s:0:"";s:17:"doors_menu_sticky";s:1:"1";s:16:"doors_show_title";s:3:"off";s:21:"doors_footer_bg_image";s:82:"http://themes.webdevia.com/windows-doors/wp-content/uploads/2014/08/footer-bg-.jpg";s:15:"footer_bg_color";s:0:"";s:17:"footer_text_color";s:0:"";s:15:"doors_copyright";s:44:"© 2020 Windows & Doors All rights reserved.";s:15:"doors_poweredby";s:15:"Windows & Doors";s:20:"copyright_text_color";s:0:"";s:10:"doors_logo";s:77:"http://themes.webdevia.com/windows-doors/wp-content/uploads/2014/08/logo2.png";s:14:"doors_404_page";s:0:"";s:15:"doors_home_page";s:0:"";s:13:"doors_favicon";s:0:"";s:22:"doors_theme_custom_css";s:5:"light";s:16:"wrapper_bg_color";s:0:"";s:13:"primary_color";s:7:"#265fb4";s:15:"secondary_color";s:0:"";s:16:"adress_bar_color";s:0:"";s:16:"social_bar_color";s:0:"";s:12:"copyright_bg";s:7:"#0c162b";s:9:"header_bg";s:0:"";s:12:"container_bg";s:0:"";s:20:"doors_footer_columns";s:12:"four_columns";s:21:"navigation_text_color";s:0:"";s:26:"navigation_bg_color_sticky";s:0:"";s:18:"language_area_html";s:0:"";s:22:"doors_show_wpml_widget";s:0:"";s:7:"twitter";s:0:"";s:8:"facebook";s:0:"";s:6:"flickr";s:0:"";s:5:"vimeo";s:0:"";s:5:"phone";s:12:"458-362-1258";s:6:"adress";s:14:"547, San Diego";s:23:"doors_body_font_familly";s:4:"Lato";s:21:"doors_body_font_style";s:6:"normal";s:23:"doors_font-weight-style";s:0:"";s:30:"doors_main_text_lettre_spacing";s:0:"";s:28:"doors_main-text-font-subsets";s:9:"latin-ext";s:23:"doors_head_font_familly";s:11:"Nunito Sans";s:21:"doors_head_font_style";s:6:"normal";s:31:"doors_heading-font-weight-style";s:3:"200";s:31:"doors_heading-text-font-subsets";s:9:"latin-ext";s:33:"doors_heading_text_lettre_spacing";s:0:"";s:29:"doors_navigation_font_familly";s:11:"Nunito Sans";s:27:"doors_navigation_font_style";s:6:"normal";s:34:"doors_navigation-font-weight-style";s:3:"300";s:34:"doors_navigation-text-font-subsets";s:9:"latin-ext";s:36:"doors_navigation_text_lettre_spacing";s:0:"";s:16:"doors_menu_style";s:9:"corporate";s:21:"doors_theme_custom_js";s:0:"";s:20:"doors_call_to_action";s:0:"";s:18:"adress_bar_bgcolor";s:0:"";s:6:"button";s:15:"Request a Quote";s:4:"work";s:29:"Office Hour: 09:00am - 4:00pm";s:22:"doors_body_font_weight";s:3:"400";s:27:"doors_body_font_weight_list";s:7:"400,700";s:20:"doors_body_font_size";s:4:"15px";s:20:"doors_head_font_size";s:4:"12px";s:36:"doors_heading-font-weight-style-list";s:23:"300,400,600,700,800,900";s:26:"doors_navigation_font_size";s:4:"12px";s:39:"doors_navigation-font-weight-style-list";s:23:"300,400,600,700,800,900";s:19:"doors_blog_bg_image";s:0:"";s:17:"doors_button_link";s:0:"";s:17:"doors_search_icon";s:1:"1";s:24:"doors_language_area_html";s:6059:"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      &lt;div id=&quot;lang_sel_list&quot; class=&quot;lang_sel_list_horizontal right&quot;&gt;
    &lt;div id=&quot;lang_sel&quot;&gt;
        &lt;ul&gt;
            &lt;li&gt;
                &lt;a class=&quot;lang_sel_sel icl-en&quot; href=&quot;#&quot;&gt;
                            &lt;img title=&quot;English&quot; alt=&quot;rn&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png&quot; class=&quot;iclflag&quot;&gt; &lt;span class=&quot;icl_lang_sel_native&quot;&gt;English&lt;/span&gt; &lt;span class=&quot;icl_lang_sel_translated&quot;&gt;&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;(&lt;/span&gt;French&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;)&lt;/span&gt;&lt;/span&gt;&lt;/a&gt;
                &lt;ul&gt;
                    &lt;li class=&quot;icl-fr&quot;&gt;
                        &lt;a href=&quot;#&quot;&gt;                          
                       &lt;img title=&quot;French &quot; alt=&quot;fr&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/fr.png&quot; class=&quot;iclflag&quot;&gt; &lt;span class=&quot;icl_lang_sel_current icl_lang_sel_native&quot;&gt;French &lt;/span&gt;
                        &lt;/a&gt;
                    &lt;/li&gt;
                    &lt;li class=&quot;icl-es&quot;&gt;
                        &lt;a href=&quot;#&quot;&gt;
                            &lt;img title=&quot;Spanish&quot; alt=&quot;es&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/es.png&quot; class=&quot;iclflag&quot;&gt;  
                            &lt;span class=&quot;icl_lang_sel_native&quot;&gt;Spanish&lt;/span&gt;
                            &lt;span class=&quot;icl_lang_sel_translated&quot;&gt;&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;(&lt;/span&gt;
                            &lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;)&lt;/span&gt;&lt;/span&gt;
                        &lt;/a&gt;
                    &lt;/li&gt;
                &lt;/ul&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ";s:15:"doors_row_width";s:4:"1370";}';
        }else{
            $file =  'a:71:{s:15:"doors_show_logo";s:1:"1";s:15:"doors_show_cart";s:1:"1";s:26:"doors_show_top_social_bare";s:0:"";s:17:"doors_box_wrapper";s:2:"of";s:18:"doors_menu_in_grid";s:0:"";s:17:"doors_menu_sticky";s:1:"1";s:16:"doors_show_title";s:3:"off";s:21:"doors_footer_bg_image";s:0:"";s:15:"footer_bg_color";s:7:"#6b4c27";s:17:"footer_text_color";s:7:"#ffffff";s:15:"doors_copyright";s:44:"© 2020 Windows & Doors All rights reserved.";s:15:"doors_poweredby";s:15:"Windows & Doors";s:20:"copyright_text_color";s:0:"";s:10:"doors_logo";s:98:"https://themes.webdevia.com/windows-doors/demo-3/wp-content/uploads/sites/3/2014/08/logo-woody.jpg";s:14:"doors_404_page";s:0:"";s:15:"doors_home_page";s:0:"";s:13:"doors_favicon";s:0:"";s:22:"doors_theme_custom_css";s:5:"light";s:16:"wrapper_bg_color";s:0:"";s:13:"primary_color";s:7:"#c39458";s:15:"secondary_color";s:0:"";s:16:"adress_bar_color";s:0:"";s:16:"social_bar_color";s:0:"";s:12:"copyright_bg";s:7:"#523614";s:9:"header_bg";s:0:"";s:12:"container_bg";s:0:"";s:20:"doors_footer_columns";s:12:"four_columns";s:21:"navigation_text_color";s:0:"";s:26:"navigation_bg_color_sticky";s:0:"";s:18:"language_area_html";s:0:"";s:22:"doors_show_wpml_widget";s:0:"";s:7:"twitter";s:0:"";s:8:"facebook";s:0:"";s:6:"flickr";s:0:"";s:5:"vimeo";s:0:"";s:5:"phone";s:12:"458-362-1258";s:6:"adress";s:14:"547, San Diego";s:23:"doors_body_font_familly";s:4:"Lato";s:21:"doors_body_font_style";s:6:"normal";s:23:"doors_font-weight-style";s:0:"";s:30:"doors_main_text_lettre_spacing";s:0:"";s:28:"doors_main-text-font-subsets";s:9:"latin-ext";s:23:"doors_head_font_familly";s:11:"Nunito Sans";s:21:"doors_head_font_style";s:6:"normal";s:31:"doors_heading-font-weight-style";s:3:"200";s:31:"doors_heading-text-font-subsets";s:9:"latin-ext";s:33:"doors_heading_text_lettre_spacing";s:0:"";s:29:"doors_navigation_font_familly";s:11:"Nunito Sans";s:27:"doors_navigation_font_style";s:6:"normal";s:34:"doors_navigation-font-weight-style";s:3:"300";s:34:"doors_navigation-text-font-subsets";s:9:"latin-ext";s:36:"doors_navigation_text_lettre_spacing";s:0:"";s:16:"doors_menu_style";s:9:"corporate";s:21:"doors_theme_custom_js";s:0:"";s:20:"doors_call_to_action";s:0:"";s:18:"adress_bar_bgcolor";s:0:"";s:6:"button";s:15:"Request a Quote";s:4:"work";s:29:"Office Hour: 09:00am - 4:00pm";s:22:"doors_body_font_weight";s:3:"400";s:27:"doors_body_font_weight_list";s:7:"400,700";s:20:"doors_body_font_size";s:4:"15px";s:20:"doors_head_font_size";s:4:"12px";s:36:"doors_heading-font-weight-style-list";s:23:"300,400,600,700,800,900";s:26:"doors_navigation_font_size";s:4:"12px";s:39:"doors_navigation-font-weight-style-list";s:23:"300,400,600,700,800,900";s:19:"doors_blog_bg_image";s:99:"http://themes.webdevia.com/windows-doors/demo-3/wp-content/uploads/sites/3/2021/05/numbers-bg-1.jpg";s:17:"doors_button_link";s:0:"";s:17:"doors_search_icon";s:1:"1";s:24:"doors_language_area_html";s:6488:"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &lt;div id=&quot;lang_sel_list&quot; class=&quot;lang_sel_list_horizontal right&quot;&gt;
    &lt;div id=&quot;lang_sel&quot;&gt;
        &lt;ul&gt;
            &lt;li&gt;
                &lt;a class=&quot;lang_sel_sel icl-en&quot; href=&quot;#&quot;&gt;
                            &lt;img title=&quot;English&quot; alt=&quot;rn&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png&quot; class=&quot;iclflag&quot;&gt; &lt;span class=&quot;icl_lang_sel_native&quot;&gt;English&lt;/span&gt; &lt;span class=&quot;icl_lang_sel_translated&quot;&gt;&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;(&lt;/span&gt;French&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;)&lt;/span&gt;&lt;/span&gt;&lt;/a&gt;
                &lt;ul&gt;
                    &lt;li class=&quot;icl-fr&quot;&gt;
                        &lt;a href=&quot;#&quot;&gt;                          
                       &lt;img title=&quot;French &quot; alt=&quot;fr&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/fr.png&quot; class=&quot;iclflag&quot;&gt; &lt;span class=&quot;icl_lang_sel_current icl_lang_sel_native&quot;&gt;French &lt;/span&gt;
                        &lt;/a&gt;
                    &lt;/li&gt;
                    &lt;li class=&quot;icl-es&quot;&gt;
                        &lt;a href=&quot;#&quot;&gt;
                            &lt;img title=&quot;Spanish&quot; alt=&quot;es&quot; src=&quot;http://themes.webdevia.com/metro-blocks-wp/wp-content/plugins/sitepress-multilingual-cms/res/flags/es.png&quot; class=&quot;iclflag&quot;&gt;  
                            &lt;span class=&quot;icl_lang_sel_native&quot;&gt;Spanish&lt;/span&gt;
                            &lt;span class=&quot;icl_lang_sel_translated&quot;&gt;&lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;(&lt;/span&gt;
                            &lt;span class=&quot;icl_lang_sel_bracket&quot;&gt;)&lt;/span&gt;&lt;/span&gt;
                        &lt;/a&gt;
                    &lt;/li&gt;
                &lt;/ul&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ";s:15:"doors_row_width";s:4:"1370";s:14:"headings_color";s:7:"#331f00";}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ";s:15:"doors_row_width";s:4:"1370";}';
        }

        $options_array = array();

        $options_array = unserialize($file);
        update_option("doors_options_array",$options_array);

    }
    add_action('wp_ajax_doors_import_options', 'doors_import_options');
}

function delete_nav_menus(){
    $menus_list=get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    foreach($menus_list as $menu){
        wp_delete_nav_menu($menu->term_id);
    }
}