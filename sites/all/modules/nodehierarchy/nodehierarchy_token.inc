<?php
// $Id: nodehierarchy_token.inc,v 1.2.2.2 2008/05/14 22:22:00 ronan Exp $

/**
 * @file
 * token.module integration functions for nodehierarchy.module
 */


function nodehierarchy_token_values($type, $object = NULL, $options = array()) {
  $tokens = array();
  if ($type == 'node') {
    $node = $object;
    if ($parent = node_load($node->parent)) {
      $tokens['hierarchyparenttitle']        = check_plain(@$parent->title);
      $tokens['hierarchyparenttitle-raw']    = @$parent->title;
      $tokens['hierarchyparentnid']          = $node->parent;

    }
    else {
      $tokens['hierarchyparenttitle']        = '';
      $tokens['hierarchyparenttitle-raw']    = '';
      $tokens['hierarchyparentnid']          = '';
    }
    $tokens['hierarchytitlepath']          = nodehierarchy_token_get_hierarchytitlepath($node);
    $tokens['fullhierarchytitlepath']      = nodehierarchy_token_get_fullhierarchytitlepath($node);
    $tokens['hierarchytitlepath-raw']      = nodehierarchy_token_get_hierarchytitlepath($node, TRUE);
    $tokens['fullhierarchytitlepath-raw']  = nodehierarchy_token_get_fullhierarchytitlepath($node, TRUE);
    $tokens['hierarchypath']               = nodehierarchy_token_get_hierarchypath($node);
    $tokens['fullhierarchypath']           = nodehierarchy_token_get_fullhierarchypath($node);
  }
  return $tokens;
}

function nodehierarchy_token_list($type = 'all') {
  if ($type == 'node' || $type == 'all') {
    $tokens['node']['hierarchyparenttitle']         = t("The node's parent's title.");
    $tokens['node']['hierarchyparenttitle-raw']     = t("The node's parent's title. WARNING - raw user input.");
    $tokens['node']['hierarchyparentnid']           = t("The node's parent's nid.");


    $tokens['node']['hierarchytitlepath']          = t("The node's ancestors' titles in order. Separated by /.");
    $tokens['node']['hierarchytitlepath-raw']      = t("The node's ancestors' titles in order. Separated by /. WARNING - raw user input.");
    $tokens['node']['fullhierarchytitlepath']      = t("The node's ancestors' titles in order the title of the node itself. Separated by /. Equivalent of [hierarchypath]/[title].");
    $tokens['node']['fullhierarchytitlepath-raw']  = t("The node's ancestors' titles in order the title of the node itself. Separated by /. Equivalent of [hierarchypath]/[title]. WARNING - raw user input.");

    $tokens['node']['hierarchypath']               = t('The url of the parent of the given node. To be used with pathauto. Should be used if any descendant node has a url not generated by pathauto (ie: hand edited)');
    $tokens['node']['fullhierarchypath']           = t('The url of the parent of the given node with the node title itself. Equivalent of [hierarchyurl]/[title]');
    return $tokens;
  }
}


function nodehierarchy_token_get_fullhierarchytitlepath($node, $raw = TRUE) {
  $title = $raw ? $node->title : check_plain($node->title);

  // return the hierarchy path with the converted title
  return trim(nodehierarchy_token_get_hierarchytitlepath($node, $raw) ."/". $title, "/");
}

function nodehierarchy_token_get_hierarchytitlepath($node, $raw = TRUE) {
  // the hierarchy path is the parent node's full hierarchy path
  if ($node->parent) {
    return nodehierarchy_token_get_fullhierarchytitlepath(node_load($node->parent));
  }
  return "";
}

function nodehierarchy_token_get_fullhierarchypath($node) {
  return trim(nodehierarchy_token_get_hierarchypath($node) ."/". $node->title, "/");
}

function nodehierarchy_token_get_hierarchypath($node) {
  // the hierarchy path is the parent node's full hierarchy path
  if ($node->parent) {
    // if the parent already has an alias (generated or entered) use that
    $parent_path = drupal_get_path_alias("node/$node->parent");
    if ($parent_path != "node/$node->parent") {
      // replace the separator with a space, so that pathauto replaces it with the separator again.
      // a little hacky but prevents the separator from being stripped
      return str_replace(variable_get('pathauto_separator', '-'), " ", $parent_path);
    }
    else {
      // recurse
      return nodehierarchy_token_get_fullhierarchypath(node_load($node->parent));
    }
  }
  return "";
}