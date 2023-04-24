<?php

if( !defined('ABSPATH') )
{
      die('You cannot be here');
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'load_carbon_fields');
add_action('carbon_fields_register_fields', 'create_options_page');

function load_carbon_fields()
{
      \Carbon_Fields\Carbon_Fields::boot();
}

// Helper function to get all pages
function get_all_pages() {
    $pages = get_pages();
    $options = array();
    foreach ($pages as $page) {
        $options[$page->ID] = $page->post_title;
    }
    return $options;
}

function create_options_page()
{
      Container::make('theme_options', __('CN - Opciones'))

            ->set_page_menu_position(30)

            ->set_icon('dashicons-universal-access-alt')
            

            

            ->add_fields(array(

                  Field::make( 'html', 'crb_information_text' )
                        ->set_html( '<h1>Calculadora Nutricional - Página de configuración</h1><p>Para utilizar el plugin hay que ingresar el shortcode [calculadora-nutricional]</p>' ),

                  Field::make('checkbox', 'cn_plugin_active', __('Plugin Activo')),

                  Field::make('text', 'cn_plugin_recipient', __('Default Email'))
                        ->set_attribute('placeholder', 'eg. your@email.com')
                        ->set_help_text('El correo que se utilizará para recibir los envíos si no hay ningún asesor definido'),
                  Field::make('select', 'cn_plugin_redirect_url', 'Elegir página para redirecionar después del envío')
                        ->add_options(get_all_pages())
                        ->set_required(true),

                  Field::make('textarea', 'cn_plugin_message', __('Mensaje de Confirmación'))
                        ->set_attribute('placeholder', 'Enter confirmation message')
                        ->set_help_text('El mensaje que se mostrará al usuario luego de rellenar los datos. Se puede utilizar la etiqueta {name}'),

                  Field::make( 'complex', 'cn_plugin_asesores', __( 'Asesores' ) )
                        ->add_fields( array(
                              Field::make( 'text', 'asesor_nombre', __( 'Asesor Nombre' ) ),
                              Field::make( 'text', 'asesor_email', __( 'Asesor Email' ) ),
                        ) )

                  ));





            
      
}
