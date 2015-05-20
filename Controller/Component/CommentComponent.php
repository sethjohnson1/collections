<?
/*
Returns all comments for a given template, and includes user interaction data where applicable for the commentswidget Element
*/
App::uses('Component', 'Controller');
class CommentComponent extends Component {	
	public $components = array('Cookie');
	function startup(Controller $controller) { $this->Controller = $controller; }

		//simplifying my approach here
	public function getComments($fk,$model,$userid){
	//first get all the comments interacted with for given record
		$CommentsUser=ClassRegistry::init('CommentsUser');
		$options['recursive']=2;
		$options['limit']=200;
		//this is where you could do pagination manually (pass the variable from the controller)
		//$options['offset']=0;
		$options['fields']=array('CommentsUser.*','Comment.*');
		$options['conditions']=array('CommentsUser.user_id'=>$userid,'Comment.foreign_key'=>$fk,'Comment.model'=>$model,'Comment.hidden != 1');
		$ucomments=$CommentsUser->find('all',$options);
		
	//now get all the comments for given record
		
		$Comment=ClassRegistry::init('Comment');
		$conditions=array('Comment.hidden != 1','Comment.foreign_key'=>$fk,'Comment.model'=>$model);
		$comments=$Comment->find('threaded',array('conditions'=>$conditions));
	
	//now run some loops, goes three layers deep. I think if I were smarter I could do this better.. oh well.
	$result=array();
	foreach ($comments as $key=>$comment){
	//stop doing it if there's nothing left
	if (!empty($ucomments)){
		if (count($comment['children'])>0){
			foreach($comment['children'] as $kchild=>$child){
				if (count($child['children'])>0){
					foreach($child['children'] as $klast=>$last){
						$result[$key]['children'][$kchild]['children'][$klast]=$comments[$key]['children'][$kchild]['children'][$klast];
						foreach ($ucomments as $k=>$v){
						if ($v['CommentsUser']['comment_id']==$last['Comment']['id']){
							$result[$key]['children'][$kchild]['children'][$klast]=array_merge($ucomments[$k],$comments[$key]['children'][$kchild]['children'][$klast]);
							unset($ucomments[$k]);
						}
						}
					}
				}
				$result[$key]['children'][$kchild]=$comments[$key]['children'][$kchild];
				foreach ($ucomments as $k=>$v){
				//first set the result
				
				if ($v['CommentsUser']['comment_id']==$child['Comment']['id']){
					$result[$key]['children'][$kchild]=array_merge($ucomments[$k],$comments[$key]['children'][$kchild]);
					//make looping gradually faster!
					unset($ucomments[$k]);
				}
				//else $result[$key]['children'][$kchild]=$comments[$key]['children'][$kchild];
				}
			}
		}
		$result[$key]=$comments[$key];
		foreach ($ucomments as $c=>$u){
			
			if ($u['CommentsUser']['comment_id']==$comment['Comment']['id']){
				$result[$key]=array_merge($ucomments[$c],$comments[$key]);
				//make looping gradually faster!
				unset($ucomments[$c]);
			}
			else {
				
			}
		}
	}
	}
		
		return $result;
	}

	//this was the original method named getComments renamed so I didn't have to change code all over
	public function getOldComments ($fk, $model, $userid){
	$this->Controller->set('cookie_flags',$this->Cookie->read('flagged_comments'));
	//now find the comments the user interacted with and tack that on
	//first find all comments that the logged in user has interacted with 
		$CommentsUser=ClassRegistry::init('CommentsUser');
		$options['joins']= array(
			array(
				'table' => 'comments',
				'alias' => 'Comment1',
				'type' => 'LEFT OUTER',
				'conditions'=>array('CommentsUser.comment_id = Comment1.id','Comment1.foreign_key'=>$fk,'Comment1.model'=>$model,'Comment1.parent_id is null')
			));
		$options['recursive']=2;
		$options['limit']=200;
		//this is where you could do pagination manually (pass the variable from the controller)
		//$options['offset']=0;
		$options['fields']=array('CommentsUser.*','Comment.*');
		//no, better to sort the array, this is meaningless
		$options['order']=array('Comment.diff desc');
		$options['conditions']=array('CommentsUser.user_id'=>$userid,'Comment.foreign_key'=>$fk,'Comment.model'=>$model,'Comment.hidden != 1','Comment.parent_id is null');

		$comment=$CommentsUser->find('all',$options);
		//now loop through and extract the ids to exclude from the next query
		$exclusions=array();
		foreach ($comment as $key=>$val){
			$exclusions[$key]="Comment.id != '".$val['Comment']['id']."'";
		}
		
		$Comment=ClassRegistry::init('Comment');
		$comment2=$Comment->find('all',array(
			'conditions'=>array('Comment.parent_id is null','Comment.hidden != 1','Comment.foreign_key'=>$fk,'Comment.model'=>$model,'AND'=>array($exclusions)),
			'recursive'=>1,
			'fields'=>array('Comment.*','User.*'),
			'limit'=>200,
			'order'=>'Comment.diff desc'
		));
		$comment3=array();
		foreach ($comment2 as $key=>$value){
			$comment3[$key]['Comment']=$value['Comment'];
			$comment3[$key]['Comment']['User']=$value['User'];
		}
		$result=array_merge($comment,$comment3);
		
		return $result;
	}
	
	//$id is the id of the comment
	public function getComment ($id, $userid){
		$this->Controller->set('cookie_flags',$this->Cookie->read('flagged_comments'));
		$model=ClassRegistry::init('CommentsUser');
		$conditions=array('CommentsUser.comment_id'=>$id);
		if (isset($userid)) $conditions['CommentsUser.user_id']=$userid;
		$comment=$model->find('first',array(
			'conditions'=>$conditions,
			'recursive'=>2,
			'fields'=>array('Comment.*','CommentsUser.*'),
			'limit'=>200,
			'order'=>'Comment.diff desc'
		));
		//$result=array_merge($comment,$comment3);
		$comment['Comment']['User']=$comment['Comment']['Comment']['User'];
		unset($comment['Comment']['Comment']);
		if (!isset($userid)) unset($comment['CommentsUser']);
		return $comment;
	}
	
	public function userComment ($fk,$model, $userid){
		$Comment=ClassRegistry::init('Comment');
		$options['conditions']=array('Comment.foreign_key'=>$fk,'Comment.model'=>$model,'Comment.user_id'=>$userid);
		$options['recursive']=1;
		//should only return one record
		$result=$Comment->find('first',$options);
		return $result;
	}
		
}