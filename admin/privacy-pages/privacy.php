<?php
$page_policy = get_page_by_path('informativa-sul-trattamento-dei-dati-personali');
$policy_file = file_get_contents( plugin_dir_path(dirname(__FILE__)) . 'privacy-pages/privacy-policy.html');

$patterns = array();
$patterns[0] = '/replace_privacy_1/';
$patterns[1] = '/replace_privacy_2/';
$replacements = array();
$replacements[0] = $domain;
$replacements[1] = $date;
$policy_file = wp_filter_post_kses(preg_replace($patterns, $replacements, $policy_file));

if ($page_policy->ID != '') {
  $policy_page = array(
    'ID' => $page_policy->ID,
    'post_content' => $policy_file,
    'post_status' => 'publish',
  );
  $post_id = wp_update_post($policy_page, true);
  if (is_wp_error($post_id)) {
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['status'] = 'error';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['message'] = esc_attr__("informativa-sul-trattamento-dei-dati-personali could not be update!", $this->plugin_name);
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['action'] = 'updated';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['post_id'] = $post_id;
  } else {
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['status'] = 'success';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['message'] = esc_attr__("informativa-sul-trattamento-dei-dati-personali updated successfully!", $this->plugin_name);
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['action'] = 'updated';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['post_id'] = $post_id;
  }

} else {
  $policy_page = array(
    'post_title' => 'Informativa sul trattamento dei dati personali',
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_content' => $policy_file,
  );
  $post_id = wp_insert_post($policy_page, true);
  if (is_wp_error($post_id)) {
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['status'] = 'error';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['message'] = esc_attr__("informativa-sul-trattamento-dei-dati-personali could not be created!", $this->plugin_name);
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['action'] = 'created';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['post_id'] = $post_id;
  } else {
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['status'] = 'success';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['message'] = esc_attr__("informativa-sul-trattamento-dei-dati-personali created successfully!", $this->plugin_name);
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['action'] = 'created';
    $create_pages_resposes['informativa-sul-trattamento-dei-dati-personali']['post_id'] = $post_id;
  }

}