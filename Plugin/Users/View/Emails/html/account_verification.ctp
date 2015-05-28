<?
$link=Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'verify', 
'email', $user[$model]['email_token']), true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>online collections account verification</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<!-- E-mail content for "Verify your iScout account" This is revised by following this tutorial: http://webdesign.tutsplus.com/tutorials/what-you-should-know-about-html-email--webdesign-12908 -->
			
	<table style="width:600px; border: 1px solid #aa9c8f; background-color:#ede9e7;">
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 18px; color:#766a62; padding:10px;">
			<strong>Hello <?=$user[$model]['username']?>,</strong>
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 14px; color:#766a62; padding:10px;">
			Your account for the Buffalo Bill Center of the West Online Collections has been created. Just click the link below within 24 hours to validate your 
			account and log in.
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 16px; padding:10px;">
			<?=$this->Html->link('Click this link to verify your account',$link,array(
				'style'=>'color:#bd4f19'
			))?>
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 14px; color:#766a62; padding:10px;">If you did not create an account, simply delete this e-mail, OR, stop by and check out the Center of the West Online Collections.
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 16px; color:#bd4f19; padding:10px;">Have fun searching our collections!</td>
		</tr>
		<tr>
		<td style="padding:10px;">
		<? //=$this->Html->image(Configure::read('globalSiteURL').'/img/iScout-Icon-small.gif')?>
		</td>
		</tr>
	</table>
	
	</body>
</html>
