<br /><br />
<div id="contact_us_box">
	<h2>ASK US A QUESTION</h2>
	<form name="ContactUs" id="ContactUs">
	<table>
		<tr><td colspan="3" width="240" height="10"></td></tr>
		<tr>
			<td width="10"></td>
			<td width="75" height="25">Name: </td>
			<td><input type="text" name="Name" id="Name" class="txt" /></td>
		</tr>
		<tr>
			<td width="10"></td>
			<td height="25">Phone: </td>
			<td><input type="text" name="Phone" id="Phone" class="txt" /></td>
		</tr>
		<tr>
			<td width="10"></td>
			<td height="25">Email: </td>
			<td><input type="text" name="Email" id="Email" class="txt" /></td>
		</tr>
		<tr>
			<td width="10"></td>
			<td>Question: </td>
			<td><textarea name="Message" id="Message" class="area"></textarea></td>
		</tr>
		<tr><td colspan="3" height="15"></td></tr>
		<tr>
			<td width="10"></td>
			<td></td>
			<td><img src="<?php echo $themePath; ?>/images/btn_submit.gif" width="82" height="22" onclick="xmlhttpPost('<?php echo $themePath; ?>/submit_form.php');" /></td>
		</tr>
	</table>
	</form>		 
</div>