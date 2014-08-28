<?php
/**
 * Copyright 2009 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$_actionLinks = array();
if (!empty($displayUrlToComment)) {
	$_actionLinks[] = sprintf('<a href="%s">%s</a>', $urlToComment . '/' . $comment['Comment']['slug'], __d('comments', 'View'));
}

if (!empty($allowAddByAuth)) {
	$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Reply'), array_merge($url, array('comment' => $comment['Comment']['id'], '#' => 'comment' . $comment['Comment']['id'])));
	$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Quote'), array_merge($url, array('comment' => $comment['Comment']['id'], 'quote' => 1, '#' => 'comment' . $comment['Comment']['id'])));
	if (!empty($isAdmin)) {
		if (empty($comment['Comment']['approved'])) {
//sj-the comment action 'toggleApprove' being passed here was wrong, changed to comment_action as the Component is looking for
//also there was a malformed variable call - fixed		
			$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Publish'), array_merge($url, array('comment' => $comment['Comment']['id'], 'comment_action' => 'toggle_approve', '#' => 'comment' . $comment['Comment']['id'])));
		} else {
			$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Unpublish'), array_merge($url, array('comment' => $comment['Comment']['id'], 'comment_action' => 'toggle_approve', '#' => 'comment' . $comment['Comment']['id'])));
		}
	}
}
$_userLink = $comment[$userModel]['username'];
$date=date_create($comment['Comment']['created']);?>
<div class="comment">
    <div class="grav"><? 
	
	//there is a glitch when paginated results miss the first gravatar for some reason, need to look at later
	if (!empty($comment['UserModel']['email'])) $em=$comment['UserModel']['email'];
	else $em=null;
	
	echo $this->Gravatar->get_gravatar($em,true,$comment[$userModel]['username']);
	
	?></div>
    <div class="coms">
            <div class="header">
                <span class="author"><?php echo $_userLink; ?></span><span style="float: right"><?php echo join('&nbsp;', $_actionLinks);?></span><br />
        
                <span class="date"><?php echo date_format($date,'F j,Y').' at '.date_format($date,'g:i A') ?></span>
                
            </div>
            <div class="body">
                <?php echo $this->Cleaner->bbcode2js($comment['Comment']['title']).'<br>'.$this->Cleaner->bbcode2js($comment['Comment']['body']);?>
            </div>
    </div>    
</div>

<div class="clear"></div>