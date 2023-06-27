<?php

if (!defined('ABSPATH')) {
      die('You cannot be here');
}

add_action('wp_enqueue_scripts', 'load_jquery');

add_shortcode('calculadora-nutricional', 'show_calculadora_nutricional');

add_action('rest_api_init', 'create_rest_endpoint');

add_action('init', 'create_submissions_page');

add_action('add_meta_boxes', 'create_meta_box');

add_filter('manage_submission_posts_columns', 'custom_submission_columns'); // add columns to the post type submissions

add_action('manage_submission_posts_custom_column', 'fill_submission_columns', 10, 2);

add_action('admin_init', 'setup_search');

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('admin_enqueue_scripts', 'admin_style');

function myplugin_query_vars( $qvars ) {
	$qvars[] = 'nombre';
	$qvars[] = 'asesor';
	return $qvars;
}
add_filter( 'query_vars', 'myplugin_query_vars' );


function load_jquery() {
      wp_enqueue_script('jquery');
}

function enqueue_custom_scripts() {
      // Enqueue custom css for plugin
      wp_enqueue_style('contact-form-plugin', MY_PLUGIN_URL . 'assets/css/frontend-styles.css',[],1.2,'all');
}

function admin_style() {
      // Enqueue custom css for admin page
      wp_enqueue_style('admin-styles', MY_PLUGIN_URL.'assets/css/admin-styles.css',[],1.2,'all');
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
                  and meta_key in ('name','email','sexo','edad','asesor','IMC')
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
      // Fill the columns with metadata

      switch ($column) {

            case 'name':
                  echo esc_html(get_post_meta($post_id, 'name', true));
                  break;

            case 'email':
                  echo esc_html(get_post_meta($post_id, 'email', true));
                  break;

            case 'telefono':
                  echo esc_html(get_post_meta($post_id, 'telefono', true));
                  break;

            case 'asesor':
                  echo esc_html(get_post_meta($post_id, 'asesor', true));
                  break;

            case 'sexo':
                  echo esc_html(get_post_meta($post_id, 'sexo', true));
                  break;

            case 'edad':
                  echo esc_html(get_post_meta($post_id, 'edad', true));
                  break;

            case 'IMC':
                  echo esc_html(get_post_meta($post_id, 'IMC', true));
                  break;

      }
}

function custom_submission_columns($columns) {
      // Edit the columns for the submission table

      $cols = array(

            'cb' => $columns['cb'],
            'name' => __('Name', 'contact-plugin'),
            'email' => __('Email', 'contact-plugin'),
            'telefono' => __('telefono', 'contact-plugin'),
            'asesor' => __('Asesor', 'contact-plugin'),
            'sexo' => __('Sexo', 'contact-plugin'),
            'edad' => __('Edad', 'contact-plugin'),
            'IMC' => __('IMC', 'contact-plugin'),
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

      $name = esc_html(get_post_meta(get_the_ID(), 'name', true));
      $email = esc_html(get_post_meta(get_the_ID(), 'email', true));
      $telefono = esc_html(get_post_meta(get_the_ID(), 'telefono', true));
      $asesor = esc_html(get_post_meta(get_the_ID(), 'asesor', true));
      $sexo = esc_html(get_post_meta(get_the_ID(), 'sexo', true));
      $edad = esc_html(get_post_meta(get_the_ID(), 'edad', true));
      $altura = esc_html(get_post_meta(get_the_ID(), 'altura', true));
      $peso = esc_html(get_post_meta(get_the_ID(), 'peso', true));
      $cintura = esc_html(get_post_meta(get_the_ID(), 'cintura', true));
      $cuello = esc_html(get_post_meta(get_the_ID(), 'cuello', true));
      $cadera = esc_html(get_post_meta(get_the_ID(), 'cadera', true));
      $actividad_fisica = esc_html(get_post_meta(get_the_ID(), 'actividad-fisica', true));

      $IMC = esc_html(get_post_meta(get_the_ID(), 'IMC', true));
      $metab_basal = esc_html(get_post_meta(get_the_ID(), 'metab-basal', true));
      $porcentaje_grasa = esc_html(get_post_meta(get_the_ID(), 'porcentaje-grasa', true));
      $kg_grasa = esc_html(get_post_meta(get_the_ID(), 'kg-grasa', true));
      $kg_musculo = esc_html(get_post_meta(get_the_ID(), 'kg-musculo', true));
      $proteina_diaria = esc_html(get_post_meta(get_the_ID(), 'proteina-diaria', true));

// metabolismo basal


      echo "
      <div id='submission-page'>
            <div class='datos'>
                  <h2>Datos ingresados por el usuario</h2>
                  <ul>
                        <li><strong>Nombre:</strong> {$name}</li>
                        <li><strong>Email:</strong> {$email}</li>
                        <li><strong>Teléfono:</strong> {$telefono}</li>
                        <li><strong>Asesor elegido:</strong> {$asesor}</li>
                        <li><strong>Sexo:</strong> {$sexo}</li>
                        <li><strong>Edad:</strong> {$edad}</li>
                        <li><strong>Altura:</strong> {$altura}</li>
                        <li><strong>Peso:</strong> {$peso}</li>
                        <li><strong>Cintura:</strong> {$cintura}</li>
                        <li><strong>Cuello:</strong> {$cuello}</li>
                        <li><strong>Cadera:</strong> {$cadera}</li>
                        <li><strong>Actividad Física:</strong> {$actividad_fisica}</li>
                  
                  </ul>          
            </div>
            <div class='calculations'>
                  <h2>Calculos realizados</h2>
                  <ul>
                        <li><strong>IMC:</strong> {$IMC}</li>
                        <li><strong>Metabolismo basal:</strong> {$metab_basal}</li>
                        <li><strong>Porcentaje de grasa:</strong> {$porcentaje_grasa}</li>
                        <li><strong>Kg de grasa:</strong> {$kg_grasa}</li>
                        <li><strong>Kg de músculo:</strong> {$kg_musculo}</li>
                        <li><strong>Proteina diaria:</strong> {$proteina_diaria}</li>
                  
                  </ul> 
            </div>
   
      </div>
      ";
 
}

function create_submissions_page() {

      // Create the submissions post type to store form submissions

      $args = [

            'public' => true,
            'has_archive' => true,
            'menu_position' => 30,
            'menu_icon' => 'dashicons-universal-access',
            'publicly_queryable' => false, // view the post in the frontend
            'labels' => [

                  'name' => 'CN - envíos',
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

function show_calculadora_nutricional() {
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
          /////////////////
      // SATINIZATION OF DATA
      /////////////////
      
      // Handle the form data that is posted

      // Get all parameters from form
      $params = $data->get_params();
    
      // Set fields from the form
      $field_name = sanitize_text_field($params['name']);
      $field_email = sanitize_email($params['email']);
      $field_telefono = sanitize_text_field($params['telefono']);
      
      $field_asesor = sanitize_text_field($params['asesor']);

      $field_sexo = sanitize_text_field($params['sexo']);
      $field_edad = intval(sanitize_text_field($params['edad']));
      $field_altura = intval(sanitize_text_field($params['altura']));
      $field_peso = intval(sanitize_text_field($params['peso']));
      $field_cintura = intval(sanitize_text_field($params['cintura']));
      $field_cuello = intval(sanitize_text_field($params['cuello']));
      $field_cadera = intval(sanitize_text_field($params['cadera']));
      $field_actividad_fisica = sanitize_text_field($params['actividad-fisica']);

      /////////////////
      // CALCULATIONS
      /////////////////

      $field_IMC = round($field_peso / pow(0.01 * $field_altura,2),2);
      
      if ($field_sexo == 'hombre') {
            
            $field_metab_basal = round(66.5+(13.8*$field_peso)+(5*$field_altura)-(6.8*$field_edad));
            
            
            $field_porcentaje_grasa = round(495 / (1.0324 - 0.19077 * log10($field_cintura - $field_cuello) + (0.15456 * log10($field_altura))) - 450);

      } else {
            
            $field_metab_basal = round(655+(9.6*$field_peso)+(1.85*$field_altura)-(4.7*$field_edad));

            $field_porcentaje_grasa = round(495/(1.29579-(0.35004*log10($field_cintura-$field_cuello+$field_cadera))+(0.221*log10($field_altura)))-450);
            
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

      // Check if nonce is valid, if not, respond back with error
      if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {

            return new WP_Rest_Response('Message not sent', 422);
      }

      // Remove unneeded data from paramaters
      unset($params['_wpnonce']);
      unset($params['_wp_http_referer']);


      // Loop through each field posted and sanitize it
      foreach ($params as $label => $value) {

            switch ($label) {

                  case 'email':

                        $value = sanitize_email($value);
                        break;

                  default:

                        $value = sanitize_text_field($value);
            }

      }

      // CREATE AND INSERT CUSTOM POST TYPE AND CUSTOM FIELDS
      $postarr = [

            'post_title' => $params['name'],
            'post_type' => 'submission',
            'post_status' => 'publish'

      ];

      $post_id = wp_insert_post($postarr); // insert the post type

      // insert the custom post fields
      add_post_meta($post_id, 'name', $field_name);
      add_post_meta($post_id, 'email', $field_email);
      add_post_meta($post_id, 'telefono', $field_telefono);
      add_post_meta($post_id, 'asesor', $field_asesor);
      add_post_meta($post_id, 'sexo', $field_sexo);
      add_post_meta($post_id, 'edad', $field_edad);
      add_post_meta($post_id, 'altura', $field_altura);
      add_post_meta($post_id, 'peso', $field_peso);
      add_post_meta($post_id, 'cintura', $field_cintura);
      add_post_meta($post_id, 'cuello', $field_cuello);
      add_post_meta($post_id, 'cadera', $field_cadera);
      add_post_meta($post_id, 'actividad-fisica', $field_actividad_fisica);
      add_post_meta($post_id, 'IMC', $field_IMC);
      add_post_meta($post_id, 'metab-basal', $field_metab_basal);
      add_post_meta($post_id, 'porcentaje-grasa', $field_porcentaje_grasa);
      add_post_meta($post_id, 'kg-grasa', $field_kg_grasa);
      add_post_meta($post_id, 'kg-musculo', $field_kg_musculo);
      add_post_meta($post_id, 'proteina-diaria', $field_proteina_diaria);


      /////////////////
      // EMAIL
      /////////////////

      $headers = [];

      $admin_email = get_bloginfo('admin_email');
      $admin_name = get_bloginfo('name');

      // Set recipient email
      $all_asesores = get_plugin_options('cn_plugin_asesores');
      
      $recipient_email = get_plugin_options('cn_plugin_recipient');

      foreach($all_asesores as $key => $value) {
            if($value["asesor_nombre"] == $field_asesor) {
                  $recipient_email = $value["asesor_email"];
            }
      }
      if (!$recipient_email) {
            // Set admin email as recipient email if no option has been set
            $recipient_email = $admin_email;
      }


      $headers[] = "From: {$admin_name} <{$admin_email}>";
      $headers[] = "Reply-to: {$field_name} <{$field_email}>";
      $headers[] = "Content-Type: text/html";

      $subject = "{$field_name} ha completado la Calculadora Nutricional";

      $email_content = file_get_contents(__DIR__ . '/templates/email/woman-email.php');

      $message = "
      <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>This is preheader text. Some clients will show this text as a preview.</span>
      <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;' width='100%' bgcolor='#f6f6f6'>
      <tr>
            <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
            <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
            <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>

            <!-- START CENTERED WHITE CONTAINER -->
            <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>

                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                  <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
                        <tr>
                        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                        
                        <h1 style='font-family: sans-serif; font-size: 32px; font-weight: bold; margin: 0; margin-bottom: 15px;'>
                        {$field_name} ha completado sus datos en la Calculadora Nutricional
                        </h1>

                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>
                        Estos son los datos ingresados:
                        </p>

                        <ul>
                              <li><strong>Nombre:</strong> {$field_name}</li>
                              <li><strong>Email:</strong> {$field_email}</li>
                              <li><strong>Teléfono:</strong> {$field_telefono}</li>
                              <li><strong>Asesor elegido:</strong> {$field_asesor}</li>
                              <li><strong>Sexo:</strong> {$field_sexo}</li>
                              <li><strong>Edad:</strong> {$field_edad}</li>
                              <li><strong>Altura:</strong> {$field_altura}</li>
                              <li><strong>Peso:</strong> {$field_peso}</li>
                              <li><strong>Cintura:</strong> {$field_cintura}</li>
                              <li><strong>Cuello:</strong> {$field_cuello}</li>
                              <li><strong>Cadera:</strong> {$field_cadera}</li>
                              <li><strong>Actividad Física:</strong> {$field_actividad_fisica}</li>
                        
                        </ul>          

                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>
                        Con esos datos se han realizado los siguientes cálculos
                        </p>
                        <ul>
                              <li><strong>IMC:</strong> {$field_IMC}</li>
                              <li><strong>Metabolismo basal:</strong> {$field_metab_basal}</li>
                              <li><strong>Porcentaje de grasa:</strong> {$field_porcentaje_grasa}</li>
                              <li><strong>Kg de grasa:</strong> {$field_kg_grasa}</li>
                              <li><strong>Kg de músculo:</strong> {$field_kg_musculo}</li>
                              <li><strong>Proteina diaria:</strong> {$field_proteina_diaria}</li>
                        
                        </ul> 
                        
                        
                        
            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            </div>
            </td>
            <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
      </tr>
      </table>
      ";

      // send email
      wp_mail($recipient_email, $subject, $email_content, $headers);

      
      if (get_plugin_options('cn_plugin_message')) {

            $confirmation_message = get_plugin_options('cn_plugin_message');

            $confirmation_message = str_replace('{name}', $field_name, $confirmation_message);
      }
      if (get_plugin_options('cn_plugin_redirection_page')) {
            $url = get_permalink(get_plugin_options('cn_plugin_redirect_url'));
            $confirmation_message = "{$url}?nombre={$field_name}&asesor={$field_asesor}";
      }
      

      return new WP_Rest_Response($confirmation_message, 200);
}
