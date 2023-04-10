<?php

if (!defined('ABSPATH')) {
      die('You cannot be here');
}

add_shortcode('calculadora-nutricional', 'show_contact_form');

add_action('rest_api_init', 'create_rest_endpoint');

add_action('init', 'create_submissions_page');

add_action('add_meta_boxes', 'create_meta_box');

add_filter('manage_submission_posts_columns', 'custom_submission_columns'); // add columns to the post type submissions

add_action('manage_submission_posts_custom_column', 'fill_submission_columns', 10, 2);

add_action('admin_init', 'setup_search');

add_action('wp_enqueue_scripts', 'load_jquery');

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('admin_enqueue_scripts', 'admin_style');

function load_jquery() {wp_enqueue_script('jquery');}

function enqueue_custom_scripts() {
      // Enqueue custom css for plugin
      wp_enqueue_style('contact-form-plugin', MY_PLUGIN_URL . 'assets/css/frontend-styles.css');
}

function admin_style() {
      // Enqueue custom css for admin page
      wp_enqueue_style('admin-styles', MY_PLUGIN_URL.'assets/css/admin-styles.css');
}

function setup_search() {

      // Only apply filter to submissions page

      global $typenow;

      if ($typenow === 'submission') {

            add_filter('posts_search', 'submission_search_override', 10, 2);
      }
}

function submission_search_override($search, $query) {
      // Override the submissions page search to include custom meta data

      global $wpdb;

      if ($query->is_main_query() && !empty($query->query['s'])) {
            $sql    = "
              or exists (
                  select * from {$wpdb->postmeta} where post_id={$wpdb->posts}.ID
                  and meta_key in ('name','email','sexo','edad','altura','peso','cintura','cuello','cadera','actividad-fisica')
                  and meta_value like %s
              )
          ";
            $like   = '%' . $wpdb->esc_like($query->query['s']) . '%';
            $search = preg_replace(
                  "#\({$wpdb->posts}.post_title LIKE [^)]+\)\K#",
                  $wpdb->prepare($sql, $like),
                  $search
            );
      }

      return $search;
}

function fill_submission_columns($column, $post_id) {
      // Return meta data for individual posts on table

      switch ($column) {

            case 'name':
                  echo esc_html(get_post_meta($post_id, 'name', true));
                  break;

            case 'email':
                  echo esc_html(get_post_meta($post_id, 'email', true));
                  break;

            case 'sexo':
                  echo esc_html(get_post_meta($post_id, 'sexo', true));
                  break;

            case 'edad':
                  echo esc_html(get_post_meta($post_id, 'edad', true));
                  break;

            case 'altura':
                  echo esc_html(get_post_meta($post_id, 'altura', true));
                  break;

            case 'peso':
                  echo esc_html(get_post_meta($post_id, 'peso', true));
                  break;

            case 'cintura':
                  echo esc_html(get_post_meta($post_id, 'cintura', true));
                  break;

            case 'cuello':
                  echo esc_html(get_post_meta($post_id, 'cuello', true));
                  break;

            case 'cadera':
                  echo esc_html(get_post_meta($post_id, 'cadera', true));
                  break;

            case 'actividad-fisica':
                  echo esc_html(get_post_meta($post_id, 'actividad-fisica', true));
                  break;

            case 'message':
                  echo esc_html(get_post_meta($post_id, 'message', true));
                  break;
      }
}

function custom_submission_columns($columns) {
      // Edit the columns for the submission table

      $cols = array(

            'cb' => $columns['cb'],
            'name' => __('Name', 'contact-plugin'),
            'email' => __('Email', 'contact-plugin'),
            'sexo' => __('sexo', 'contact-plugin'),
            'edad' => __('edad', 'contact-plugin'),
            'altura' => __('altura', 'contact-plugin'),
            'peso' => __('peso', 'contact-plugin'),
            'cintura' => __('cintura', 'contact-plugin'),
            'cuello' => __('cuello', 'contact-plugin'),
            'cadera' => __('cadera', 'contact-plugin'),
            'actividad-fisica' => __('actividad-fisica', 'contact-plugin'),
            'message' => __('Message', 'contact-plugin'),
            'date' => 'Date',

      );

      return $cols;
}

function create_meta_box() {
      // Create custom meta box to display submission

      add_meta_box('custom_contact_form', 'Submission', 'display_submission', 'submission');
}

function display_submission() {
      // Display submission data in admin custom post type page

      ///////////////////////////
      // Dynamic way of doing it
      ///////////////////////////

      // $postmetas = get_post_meta( get_the_ID() );
      // unset($postmetas['_edit_lock']) 
      // echo '<ul>';
      // foreach($postmetas as $key => $value)
      // {
      //       echo '<li><strong>' . ucfirst($key) . ':</strong> ' . $value[0] . '</li>';
      // }
      // echo '</ul>';


      //////////////////////////////
      // Hard code way of doing it
      //////////////////////////////

      $name = esc_html(get_post_meta(get_the_ID(), 'name', true));

      echo "
      <div class='submission-page'>
            <ul>
                  <li>Nombre: {$name}</li>
            
            </ul>
      
      </div>
      ";



      // echo '<ul>';

      // echo '<li>HOLA CHAROLA</li>';

      // echo '<li><strong>Name:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'name', true)) . '</li>';
      // echo '<li><strong>Email:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'email', true)) . '</li>';
      
      // echo '<li><strong>sexo:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'sexo', true)) . '</li>';

      // echo '<li><strong>edad:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'edad', true)) . '</li>';
 
      // echo '<li><strong>altura:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'altura', true)) . '</li>';
 
      // echo '<li><strong>peso:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'peso', true)) . '</li>';
 
      // echo '<li><strong>cintura:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'cintura', true)) . '</li>';
 
      // echo '<li><strong>cuello:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'cuello', true)) . '</li>';
  
      // echo '<li><strong>cadera:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'cadera', true)) . '</li>';
  
      // echo '<li><strong>actividad-fisica:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'actividad-fisica', true)) . '</li>';

      // echo '<li><strong>Message:</strong><br /> ' . esc_html(get_post_meta(get_the_ID(), 'message', true)) . '</li>';

      // echo '</ul>';
}

function create_submissions_page() {

      // Create the submissions post type to store form submissions

      $args = [

            'public' => true,
            'has_archive' => true,
            'menu_position' => 30,
            'publicly_queryable' => false, // view the post in the frontend
            'labels' => [

                  'name' => 'Submissions',
                  'singular_name' => 'Submission',
                  'edit_item' => 'View Submission' // title of the submission edit item page

            ],
            'supports' => false,
            'capability_type' => 'post',
            'capabilities' => array(
                  'create_posts' => false,
            ),
            'map_meta_cap' => true
      ];

      register_post_type('submission', $args);
}

function show_contact_form() {
      include MY_PLUGIN_PATH . '/includes/templates/contact-form.php';
}

function create_rest_endpoint() {

      // Create endpoint for front end to connect to WordPress securely to post form data
      register_rest_route('v1/contact-form', 'submit', array(

            'methods' => 'POST',
            'callback' => 'handle_enquiry'

      ));
}


function handle_enquiry($data) {
      // Handle the form data that is posted

      // Get all parameters from form
      $params = $data->get_params();

      // Set fields from the form
      $field_name = sanitize_text_field($params['name']);
      $field_email = sanitize_email($params['email']);
      
      $field_sexo = sanitize_text_field($params['sexo']);
      $field_edad = intval(sanitize_text_field($params['edad']));
      $field_altura = intval(sanitize_text_field($params['altura']));
      $field_peso = intval(sanitize_text_field($params['peso']));
      $field_cintura = intval(sanitize_text_field($params['cintura']));
      $field_cuello = intval(sanitize_text_field($params['cuello']));
      $field_cadera = intval(sanitize_text_field($params['cadera']));
      $field_actividad_fisica = sanitize_text_field($params['actividad-fisica']);


      $field_message = sanitize_textarea_field($params['message']);

      // CALCULOS

      $field_IMC = round($field_peso / pow(0.01 * $field_altura,2),2);
      
      if ($field_sexo == 'hombre') {
            
            $field_metab_basal = round(66.5+(13.8*$field_peso)+(5*$field_altura)-(6.8*$field_edad));
            
            
            $field_porcentaje_grasa = round(495 / (1.0324 - (0.19077 * log($field_cintura - $field_cuello)) + (0.15456 * log($field_altura))) - 450);
            
      } else {
            
            $field_metab_basal = round(655+(9.6*$field_peso)+(1.85*$field_altura)-(4.7*$field_edad));

            $field_porcentaje_grasa = round(495/(1.29579-(0.35004*log($field_cintura-$field_cuello+$field_cadera))+(0.221*log($field_altura)))-450);
      }
      
      $field_kg_grasa = round($field_peso*$field_porcentaje_grasa/100);

      if ($field_sexo == 'hombre') { 
            $field_kg_musculo = round(($field_peso-$field_kg_grasa)-3.1);
      } else {
            $field_kg_musculo = round(($field_peso-$field_kg_grasa)-2.5);
      }    


      if ($field_actividad_fisica == 'activo') { 

            $field_proteina_diaria = $field_kg_musculo*2.2;

      } elseif ($field_actividad_fisica == 'moderado') {
            
            $field_proteina_diaria = $field_kg_musculo*1.8;

      } else {

            $field_proteina_diaria = $field_kg_musculo*1.2;

      }


      //=IF(C4="Hombre",
      // 495/(1.0324-(0.19077*log($field_cintura-$field_cuello))+(0.15456*log($field_altura)))-450
      // 495/(1.29579-(0.35004*log($field_cintura-$field_cuello+$field_cadera))+(0.221*log($field_altura)))-450

      //=IF(C4="Hombre",
      // 495/(1.0324-(0.19077*LOG(C8-C9))+(0.15456*LOG(C6)))-450,
      // 495/(1.29579-(0.35004*LOG(C8-C9+C10))+(0.221*LOG(C6)))-450)
      

      // $field_sexo C4
      // $field_edad C5
      // $field_altura C6
      // $field_peso C7
      // $field_cintura C8
      // $field_cuello C9
      // $field_cadera C10
      // $field_actividad_fisica C11
      // $field_IMC C13
      // $field_metab_basal C14
      // $field_porcentaje_grasa C15 
      // $field_kg_grasa C16 
      // $field_kg_musculo C17 
      // $field_proteina_diaria C18

      // Check if nonce is valid, if not, respond back with error
      if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {

            return new WP_Rest_Response('Message not sent', 422);
      }

      // Remove unneeded data from paramaters
      unset($params['_wpnonce']);
      unset($params['_wp_http_referer']);

      // Send the email message
      $headers = [];

      $admin_email = get_bloginfo('admin_email');
      $admin_name = get_bloginfo('name');

      // Set recipient email
      $recipient_email = get_plugin_options('contact_plugin_recipients');

      if (!$recipient_email) {
            // Make all lower case and trim out white space
            $recipient_email = strtolower(trim($recipient_email));
      } else {

            // Set admin email as recipient email if no option has been set
            $recipient_email = $admin_email;
      }


      $headers[] = "From: {$admin_name} <{$admin_email}>";
      $headers[] = "Reply-to: {$field_name} <{$field_email}>";
      $headers[] = "Content-Type: text/html";

      $subject = "New enquiry from {$field_name}";

      $message = '';
      $message = "<h1>Message has been sent from {$field_name}</h1>";


      $postarr = [

            'post_title' => $params['name'],
            'post_type' => 'submission',
            'post_status' => 'publish'

      ];

      $post_id = wp_insert_post($postarr);

      // Loop through each field posted and sanitize it
      foreach ($params as $label => $value) {

            switch ($label) {

                  case 'message':

                        $value = sanitize_textarea_field($value);
                        break;

                  case 'email':

                        $value = sanitize_email($value);
                        break;

                  default:

                        $value = sanitize_text_field($value);
            }

            add_post_meta($post_id, sanitize_text_field($label), $value);

            $message .= '<strong>' . sanitize_text_field(ucfirst($label)) . ':</strong> ' . $value . '<br />';
      }


      wp_mail($recipient_email, $subject, $message, $headers);

      $confirmation_message = "<h2>Contenido del form</h2>".
                              "<ul>".
                                    "<li>Name: " . $field_name . "</li>" .
                                    "<li>Email: " . $field_email . "</li>" .
                                    "<li>Sexo: " . $field_sexo . "</li>" .
                                    "<li>IMC: " . $field_IMC . "</li>" .
                                    "<li>Metab basal: " . $field_metab_basal . "</li>" .                                    "<li>% grasa: " . $field_porcentaje_grasa . "</li>" .
                                    "<li>kg grasa: " . $field_kg_grasa . "</li>" .
                                    "<li>kg musculo: " . $field_kg_musculo . "</li>" .
                                    "<li>proteina diaria: " . $field_proteina_diaria  . "</li>" .
                                    "<li>Actividad Física: " . $field_actividad_fisica . "</li>" .
                                    "<li>Message: " . $field_message . "</li>" .
                              "</ul>";

      // if (get_plugin_options('contact_plugin_message')) {

      //       $confirmation_message = get_plugin_options('contact_plugin_message');

      //       $confirmation_message = str_replace('{name}', $field_name, $confirmation_message);
      // }

      return new WP_Rest_Response($confirmation_message, 200);
}
