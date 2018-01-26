<?php

if ( function_exists( "register_field_group" ) ) {
    /**
    register_field_group(array (
        'id' => 'acf_aanmeldknop',
        'title' => 'Aanmeldknop',
        'fields' => array (
            array (
                'key' => 'field_16',
                'label' => 'Tekst',
                'name' => 'acf_ncdt_text',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array (
                'key' => 'field_17',
                'label' => 'URL',
                'name' => 'acf_ncdt_text_url',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '2',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

     */

/**
    register_field_group( array (
        'id' => 'acf_banner-voorpagina',
        'title' => 'Banner voorpagina',
        'fields' => array (
            array (
                'key' => 'field_539ea1f9502cc',
                'label' => 'Banner voorpagina',
                'name' => 'ncdt_acf_banner_voorpagina',
                'type' => 'repeater',
                'sub_fields' => array (


                    array (
                        'key' => 'field_539ea278502cf',
                        'label' => 'Afbeelding',
                        'name' => 'ncdt_acf_banner_image',
                        'type' => 'image',
                        'column_width' => '',
                        'save_format' => 'object',
                        'preview_size' => 'large',
                        'library' => 'all',
                    ),

                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'row',
                'button_label' => 'Nieuwe afbeelding toevoegen',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '2',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

     */

/**
    register_field_group(array (
        'id' => 'acf_eventsblok-ongeformateerd',
        'title' => 'Eventsblok (ongeformateerd)',
        'fields' => array (
            array (
                'key' => 'field_53a987bf8df83',
                'label' => 'Eventsblok',
                'name' => 'acf_nvdt_eventsblok',
                'type' => 'textarea',
                'instructions' => 'Voor schema.org/Event',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'html',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '2',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

     */

    register_field_group(array (
        'id' => 'acf_extra-inhoudsblokken-voorpagina',
        'title' => 'Extra inhoudsblokken voorpagina',
        'fields' => array (
            //array (
            //    'key' => 'field_6',
            //    'label' => 'Extra content blok onder Twitter blokje',
            //    'name' => 'acf_ncdt_blok1',
             //   'type' => 'wysiwyg',
            //    'instructions' => 'Blokje tekst onder het Twitter blokje, rechts naast de inhoud',
            //    'default_value' => '',
            //    'toolbar' => 'full',
            //    'media_upload' => 'yes',
            //),
            array (
                'key' => 'field_26',
                'label' => 'Titel voor sprekers of presentaties blok',
                'name' => 'acf_ncdt_sprekers_title',
                'type' => 'text',
                'instructions' => 'Geef de titel voor het blok met sprekers of presentaties',
                'default_value' => 'Sprekers',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_9',
                'label' => 'Sprekers of presentaties',
                'name' => 'acf_ncdt_sprekers',
                'type' => 'relationship',
                'instructions' => 'Welke sprekers of presentaties moeten er op de voorpagina?',
                'return_format' => 'object',
                'post_type' => array (
                    0 => 'ncdt_speakers',
                    1 => 'ncdt_talks',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => '',
            ),
            array (
                'key' => 'field_7',
                'label' => 'Extra inhoud onder sprekers of presentaties',
                'name' => 'acf_ncdt_blok2',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_13',
                'label' => 'Extra afbeelding, links, onder de sprekers of presentaties',
                'name' => 'acf_ncdt_img_blok2',
                'type' => 'image',
                'instructions' => 'Formaat afbeelding: 420pixels breed, 190 pixels hoog',
                'save_format' => 'url',
                'preview_size' => 'full',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '2',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'custom_fields',
                1 => 'discussion',
                2 => 'comments',
                3 => 'format',
                4 => 'categories',
                5 => 'tags',
                6 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_samenvatting',
        'title' => 'Samenvatting',
        'fields' => array (
            array (
                'key' => 'field_536caf4feaa4d',
                'label' => 'Samenvatting',
                'name' => 'acf_ncdt_custom_excerpt',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'ncdt_speakers',
                    'order_no' => 0,
                    'group_no' => 2,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'ncdt_talks',
                    'order_no' => 0,
                    'group_no' => 3,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
