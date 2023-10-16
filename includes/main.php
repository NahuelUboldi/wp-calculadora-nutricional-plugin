<?php
include "templates/admin-page.php";
include "templates/email.php";
include "templates/recomendations-email.php";


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

function getImages() {
      return [
		"logo" => MY_PLUGIN_URL . "includes/templates/images/logo.png",
		"recomendaciones-banner" => MY_PLUGIN_URL . "includes/templates/images/recomendaciones-banner.jpg",
		"fitness" => MY_PLUGIN_URL . "includes/templates/images/fitness.png",
	];
}

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
      $sexo = esc_html(get_post_meta(get_the_ID(), 'sexo', true));
      $asesor = esc_html(get_post_meta(get_the_ID(), 'asesor', true));
      $objetivo = esc_html(get_post_meta(get_the_ID(), 'objetivo', true));

      $objetivo_secundario = esc_html(get_post_meta(get_the_ID(), 'objetivo-secundario', true));

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

	$values = [
            "fecha" => get_the_date(),
            "nombre" => $name,
            "email" => $email,
            "telefono" => $telefono,
            "sexo" => $sexo,
            "asesor" => $asesor,
            "objetivo" => $objetivo,
            "objetivo-secundario" => $objetivo_secundario,
            "edad" => $edad,
            "estatura" => $altura,
            "peso" => $peso,
            "cintura" => $cintura,
            "cuello" => $cuello,
            "cadera" => $cadera,
            "actividad_fisica" => $actividad_fisica,
            "imc" => $IMC,
            "metab_basal" => $metab_basal,
            "%-grasa" => $porcentaje_grasa,
            "kg-grasa" => $kg_grasa,
            "kg-musculo" => $kg_musculo,
            "proteina-diaria" => $proteina_diaria,
            "calorias" => $metab_basal,
	];

	$images = getImages();
      echo createAdminPage($values,$images);
 
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
      $field_objetivo = sanitize_text_field($params['objetivo']);

      // agregar objetivo secundario
      $field_objetivo_secundario = sanitize_text_field($params['objetivo-secundario']);


      $field_sexo = sanitize_text_field($params['sexo']);
      $field_edad = intval(sanitize_text_field($params['edad']));
      $field_altura = floatval(sanitize_text_field($params['altura']));
      $field_peso = floatval(sanitize_text_field($params['peso']));
      $field_cintura = floatval(sanitize_text_field($params['cintura']));
      $field_cuello = floatval(sanitize_text_field($params['cuello']));
      $field_cadera = floatval(sanitize_text_field($params['cadera']));
      $field_actividad_fisica = sanitize_text_field($params['actividad-fisica']) ?? "activo";

      // Validations before calculations and pushing to db
      if ($field_edad < 0 || $field_edad > 125) {
            return new WP_Rest_Response('Mensaje no enviado, la edad no está dentro del rango permitido', 422);
      }
      if ($field_altura < 50 || $field_altura > 230) {
            return new WP_Rest_Response('Mensaje no enviado, la altura no está dentro del rango permitido', 422);
      }
      if ($field_peso < 45 || $field_peso > 200) {
            return new WP_Rest_Response('Mensaje no enviado, el peso no está dentro del rango permitido', 422);
      }      
      if ($field_cuello < 20 || $field_cuello > 50) {
            return new WP_Rest_Response('Mensaje no enviado, el cuello no está dentro del rango permitido', 422);
      }
      if ($field_cintura < 40 || $field_cintura > 250) {
            return new WP_Rest_Response('Mensaje no enviado, la cintura no está dentro del rango permitido', 422);
      }      
      if ($field_cadera < 40 || $field_cadera > 250) {
            return new WP_Rest_Response('Mensaje no enviado, la cadera no está dentro del rango permitido', 422);
      }

      /////////////////
      // CALCULATIONS
      /////////////////

      $field_IMC = round($field_peso / pow(0.01 * $field_altura,2),2);
      
      if ($field_sexo == 'hombre') {
            
            $field_metab_basal = round(66.5+(13.8*$field_peso)+(5*$field_altura)-(6.8*$field_edad),2);
            
            
            $field_porcentaje_grasa = round(495 / (1.0324 - 0.19077 * log10($field_cintura - $field_cuello) + (0.15456 * log10($field_altura))) - 450 - 4,2);

      } else {
            
            $field_metab_basal = round(655+(9.6*$field_peso)+(1.85*$field_altura)-(4.7*$field_edad),2);

            $field_porcentaje_grasa = round(495/(1.29579-(0.35004*log10($field_cintura-$field_cuello+$field_cadera))+(0.221*log10($field_altura)))-450 - 4,2);
            
      }
 
      $field_kg_grasa = round($field_peso*$field_porcentaje_grasa/100,2);

      if ($field_sexo == 'hombre') { 
            $field_kg_musculo = round(($field_peso-$field_kg_grasa)-3.1,2);
      } else {
            $field_kg_musculo = round(($field_peso-$field_kg_grasa)-2.5,2);
      }    


      if ($field_actividad_fisica == 'activo') { 

            $field_proteina_diaria = round($field_kg_musculo*2.2,2);

      } elseif ($field_actividad_fisica == 'moderado') {
            
            $field_proteina_diaria = round($field_kg_musculo*1.8,2);

      } else {

            $field_proteina_diaria = round($field_kg_musculo*1.2,2);

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
      add_post_meta($post_id, 'objetivo', $field_objetivo);
      //agregar objetivo secundario
      add_post_meta($post_id, 'objetivo-secundario', $field_objetivo_secundario);

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

      
      $values = [
            "fecha" => current_time('d-m-Y'),
            "nombre" => $field_name,
            "email" => $field_email,
            "telefono" => $field_telefono,
            "sexo" => $field_sexo,
            "asesor" => $field_asesor,
            "objetivo" => $field_objetivo,
            "objetivo-secundario" => $field_objetivo_secundario,
            "edad" => $field_edad,
            "estatura" => $field_altura,
            "peso" => $field_peso,
            "cintura" => $field_cintura,
            "cuello" => $field_cuello,
            "cadera" => $field_cadera,
            "actividad_fisica" => $field_actividad_fisica,
            "imc" => $field_IMC,
            "metab_basal" => $field_metab_basal,
            "%-grasa" => $field_porcentaje_grasa,
            "kg-grasa" => $field_kg_grasa,
            "kg-musculo" => $field_kg_musculo,
            "proteina-diaria" => $field_proteina_diaria,
            "calorias" => $field_metab_basal,
	];
      $images = getImages();
      
      // send email with report
      $subject = "Scanner corporal completado por {$field_name} | Reporte";
      $message = createEmail($values,$images);


      wp_mail($recipient_email, $subject, $message, $headers);

      
      // send email with recomendations 
      $recomendations_subject = "Recomendaciones para {$field_name} según los objetivos elegidos";
      $recomendations_message = createRecomendationsEmail($values,$images);
      wp_mail($recipient_email, $recomendations_subject, $recomendations_message, $headers);
      
      
      if (get_plugin_options('cn_plugin_message')) {

            $confirmation_message = get_plugin_options('cn_plugin_message');

            $confirmation_message = str_replace('{name}', $field_name, $confirmation_message);
      }
      if (get_plugin_options('cn_plugin_redirection_page')) {

            $all_objetivos = get_plugin_options('cn_plugin_redirect');
      
            foreach($all_objetivos as $key => $value) {

                  if($value["objetivo"] == $field_objetivo) {
                        $url = get_permalink( $value["objetivo_redirect"] );
                  }
            }

            $confirmation_message = "{$url}?nombre={$field_name}&asesor={$field_asesor}";
      }
      

      return new WP_Rest_Response($confirmation_message, 200);
}
