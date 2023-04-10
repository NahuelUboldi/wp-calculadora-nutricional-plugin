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

function create_options_page()
{
      Container::make('theme_options', __('CN - Opciones'))

            ->set_page_menu_position(30)

            ->set_icon('dashicons-smiley')
            

            ->add_fields(array(

                  Field::make('checkbox', 'contact_plugin_active', __('Active')),

                  Field::make('text', 'contact_plugin_recipients', __('Recipient Email'))
                        ->set_attribute('placeholder', 'eg. your@email.com')
                        ->set_help_text('The email that the form is submitted to'),

                  Field::make('textarea', 'contact_plugin_message', __('Confirmation Message'))
                        ->set_attribute('placeholder', 'Enter confirmation message')
                        ->set_help_text('Type the message you want the submitted to receive'),

                  Field::make( 'complex', 'cn_plugin_asesores', __( 'Asesores' ) )
                        ->add_fields( array(
                              Field::make( 'text', 'asesor_nombre', __( 'Asesores Nombre' ) ),
                              Field::make( 'text', 'asesor_email', __( 'Asesores Email' ) ),
                        ) )

                  ));





            
      
}
