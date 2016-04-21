<?php
// $Id: node.tpl.php,v 1.7 2007/08/07 08:39:36 goba Exp $
?>

<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>">
	<?php if ($picture) {
      print $picture;
    }?>

<?php if(false) { ?>
	<?php if ($page == 0) { ?>
	<h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2>
	<?php } ?>
<?php } ?>

	<?php
//		var_dump($node);
		$taxonomyId = key($node->taxonomy);
		if($node->type == "blog") {
	?>
	<?php if (!$page) { ?>
	<h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2>
	<?php } ?>
	<span class="submitted"><img src="/sites/integralawgroup.com/themes/integra/images/icon_profile.gif" width="16" height="13" align="absmiddle" /> <?php print $submitted?></span>
	<div class="taxonomy">In category <a href="/<?php echo drupal_get_path_alias('taxonomy/term/' . $taxonomyId); ?>"><?php echo($node->taxonomy[$taxonomyId]->name); ?></a></div>
	<?php } ?>

	<div class="content"><?php print $content?></div>
</div>