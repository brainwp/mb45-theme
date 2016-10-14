<?php
/*
 *
 * Odin Metaboxes fields
 *
*/
$page_galeria = new Odin_Metabox(
    'gallery_hair', // Slug/ID do Metabox (obrigatório)
    'Página Hair', // Nome do Metabox  (obrigatório)
    'page', // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)
    'normal', // Contexto (opções: normal, advanced, ou side) (opcional)
    'default' // Prioridade (opções: high, core, default ou low) (opcional)
);
$page_galeria->set_fields(
    array(
        array(
            'id'          => 'gallery_hair',
            'label'       => __( 'Images Gallery', 'odin' ),
            'type'        => 'image_plupload',
        )
    )
);
