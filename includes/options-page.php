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
                        ->set_html( '<div style="background:#764979;color:white;padding:10px; border-radius:0.5rem;text-align:center;font-size:1.2rem;"><h1 style="color:white;font-weight:bold">Calculadora Nutricional - Página de configuración</h1><p>Para utilizar el plugin hay que ingresar el shortcode [calculadora-nutricional]</p></div>' ),

                  Field::make('checkbox', 'cn_plugin_active', __('Plugin Activo')),

                  Field::make('text', 'cn_plugin_recipient', __('Default Email'))
                        ->set_attribute('placeholder', 'eg. your@email.com')
                        ->set_help_text('El correo que se utilizará para recibir los envíos si no hay ningún asesor definido'),

                  Field::make( 'html', 'cn_objetives_title' )
                        ->set_html( '<h1 style="background:#764979;color:white;font-weight:bold;padding:10px; border-radius:0.5rem;text-align:center;">Objetivos principales</h1>' ),

                  Field::make( 'checkbox', 'cn_plugin_redirection_page', __('Utilizar páginas de redirección')),
                  Field::make( 'complex', 'cn_plugin_redirect', __( 'Lista de objetivos' ) )
                        // ->set_conditional_logic( array(
                        //       array(
                        //             'field' => 'cn_plugin_redirection_page',
                        //             'value' => true,
                        //       )
                        // ) )
                        ->set_layout( 'tabbed-horizontal' )      
                        ->add_fields( array(
                              Field::make( 'text', 'objetivo', __( 'Objetivo de la persona' ) ),
                              Field::make( 'rich_text', 'objetivo_recomendaciones', __( 'Recomendaciones' ) ),
                              Field::make( 'select', 'objetivo_redirect', __( 'Página de redirección' ) )
                                    ->add_options(get_all_pages())
                        ) )
                        ->set_help_text('Elegir las páginas para redirecionar después del envío según los objetivos. Para recuperar los parametros [nombre] y [asesor], hay que instalar el plugin "URL Params" e insertar el código [urlparam param="parametro" /] en el lugar del texto donde se quiera hacer referencia a dichos parámetros.'),
                  
                  Field::make('textarea', 'cn_plugin_message', __('Mensaje de Confirmación'))
                        ->set_attribute('placeholder', 'Enter confirmation message')
                        ->set_help_text('El mensaje que se mostrará al usuario luego de rellenar los datos si no hay página de redirección selecionada. Se puede utilizar la etiqueta {name}'),



                  Field::make( 'html', 'cn_objetivo_secundario_title' )
                        ->set_html( '<h1 style="background:#764979;color:white;font-weight:bold;padding:10px; border-radius:0.5rem;text-align:center;">Objetivos secundarios</h1>' ),
                  Field::make( 'complex', 'cn_plugin_objetivo_secundario', __( 'Lista de objetivos secundarios' ) )

                        ->set_layout( 'tabbed-horizontal' )      
                        ->add_fields( array(
                              Field::make( 'text', 'objetivo_secundario', __( 'Objetivo secundario' ) ),
                              Field::make( 'rich_text', 'objetivo_secundario_recomendaciones', __( 'Recomendaciones' ) ),

                  ) ),
                  

                  Field::make( 'html', 'cn_asesores_title' )
                        ->set_html( '<h1 style="background:#764979;color:white;font-weight:bold;padding:10px; border-radius:0.5rem;text-align:center;">Asesores</h1>' ),                  

                  Field::make( 'complex', 'cn_plugin_asesores', __( 'Asesores' ) )
                        ->set_layout( 'tabbed-horizontal' )  
                        ->add_fields( array(
                              Field::make( 'text', 'asesor_nombre', __( 'Nombre del asesor' ) ),
                              Field::make( 'text', 'asesor_email', __( 'Email del asesor' ) ),
                  ) )

            ));




            
      
}
