<?php
// $Id: galleria.admin.inc,v 1.1.2.5 2009/03/23 14:40:16 marktheunissen Exp $

/**
 * @file
 * Administration callbacks for the galleria module.
 */

/**
 * Form builder. Configure gallerias.
 *
 * @ingroup forms
 * @see system_settings_form()
 */
function galleria_admin_settings() {

  $form['galleria_thumb_opacity'] = array(
    '#type' => 'textfield',
    '#title' => t('Opacity of thumbnails'),
    '#size' => 15,
    '#default_value' => variable_get('galleria_thumb_opacity', 0.3),
    '#description' => t('Value from 0 .. 1'),
  );

  // Code based on from Taxonomy Image's ImageCache support
  // If ImageCache module is found, add its presets as available options
  // for how to display the image.
  if (module_exists('imagecache')) {
    $raw_presets = imagecache_presets();
    $presets[''] = t('None');
    foreach ($raw_presets as $preset_id => $preset_info) {
      $preset = $preset_info['presetname'];
      $presets[$preset] = $preset;
    }
    $form['galleria_imagecache_preset'] = array(
      '#type' => 'select',
      '#title' => t('ImageCache gallery preset'),
      '#options' => $presets,
      '#default_value' => variable_get('galleria_imagecache_preset', ''),
    );

    $form['galleria_thumb_imagecache_preset'] = array(
      '#type' => 'select',
      '#title' => t('ImageCache thumbnail preset'),
      '#options' => $presets,
      '#default_value' => variable_get('galleria_thumb_imagecache_preset', ''),
    );
  }
  else {
    drupal_set_message(t('If you install the imagecache module, you will get extra options here for integration.'), 'status');
  }

  $form['galleria_show_page_warning'] = array(
    '#type' => 'checkbox',
    '#title' => t('Galleria warnings'),
    '#default_value' => variable_get('galleria_show_page_warning', 1),
    '#description' => t('Show warning and error messages on Gallerias if they aren\'t configured properly.'),
  );

  return system_settings_form($form);
}
