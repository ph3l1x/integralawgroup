<?php require_once('header.php'); ?>

<table id="body">
	<tr>
		<td width="262" class="side">
			<?php require_once('left_column.php'); ?>
		</td>
		<td width="9"></td>
		<td width="697">
			<table>
				<tr>
					<td width="696">
						<script type="text/javascript">
								swfobject.embedSWF("<?php echo $themePath; ?>/flash/main.swf", "FlashImages", "696", "490", "8.0.0");
							//swfobject.embedSWF("<?php echo $themePath; ?>/flash/txt.swf", "FlashText", "696", "70", "8.0.0");
						</script>
						<div id="FlashImages"><img src="<?php echo $themePath; ?>/images/flash.jpg" width="422" height="426" /></div>
					</td>
					<!--<td width="8"></td>
					<td width="263" class="side">
						<?php //require_once('right_column.php'); ?>
					</td> -->
				</tr>
			</table>
			<!--<div id="FlashText"><img src="<?php //echo $themePath; ?>/images/flash_text.gif" width="696" height="70" /></div> -->
			<div id="content">
				<div id="inner">
					<?php print $content; ?>
					<div class="clear"></div>
				</div>
			</div>
		</td>
	</tr>
</table>

<?php require_once('footer.php'); ?>