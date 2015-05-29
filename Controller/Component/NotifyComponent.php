<?
/*
Returns all comments for a given template, and includes user interaction data where applicable for the commentswidget Element
*/
App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class NotifyComponent extends Component {	
	public $components = array('Cookie');
	function startup(Controller $controller) { $this->Controller = $controller; }

	//$comment is the entire comment
	//$fk
	//$model
	//$user (will also have to check fo e-mail...)
	public function emailNancy($comment,$model,$fk,$user){
	if ($model=='Treasure') $clink='http://collections.centerofthewest.org/treasures/view?id='.$fk.'#comment_'.$comment['id'];
	else if ($model=='Usergal') $clink='http://collections.centerofthewest.org/usergals/view/'.$fk.'#comment_'.$comment['id'];
	else $clink='(making the link did not work!)';
	if (isset($user['email'])) $oid=$user['email'];
	else $oid=$user['oid'];
		$Email = new CakeEmail();
		$Email->from('forms@centerofthewest.org')
			->to('web@centerofthewest.org')
			->subject('Collections_comment')
			->send(
			$comment['thoughts']."\n\nFrom: ".$oid."\n\nPage:".$clink
			);
		return true;
	}
	
		
}