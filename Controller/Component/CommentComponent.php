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
	$this->Controller->set('cookie_flags',$this->Cookie->read('flagged_comments'));
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
	//loops through and adds to array as needed
		foreach($comment['children'] as $kchild=>$child){
				foreach($child['children'] as $klast=>$last){
					$result[$key]['children'][$kchild]['children'][$klast]=$comments[$key]['children'][$kchild]['children'][$klast];
					unset($comments[$key]['children'][$kchild]['children'][$klast]['children']);
					foreach ($ucomments as $k=>$v){
					if ($v['CommentsUser']['comment_id']==$last['Comment']['id']){
						$result[$key]['children'][$kchild]['children'][$klast]=array_merge($ucomments[$k],$comments[$key]['children'][$kchild]['children'][$klast]);
						unset($ucomments[$k]);
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
		//
	}
		$coptions['conditions']=array('Comment.foreign_key'=>$fk,'Comment.model'=>$model,'Comment.user_id'=>$userid);
		$coptions['recursive']=1;
		//find all the comments user left on this record then build into array (notice put the PARENT id into the array!)
		$usercomments=$Comment->find('all',$coptions);
		$uarray['usercomments']=array();
		foreach ($usercomments as $kidea=>$idea){
			if (empty($idea['Comment']['parent_id'])) $uarray['usercomments']['primary']=$idea['Comment']['thoughts'];
			else {
				$uarray['usercomments'][$idea['Comment']['parent_id']]['thoughts']=$idea['Comment']['thoughts'];
				$uarray['usercomments'][$idea['Comment']['parent_id']]['comment_id']=$idea['Comment']['id'];
			}
		}
		$newresult=array();
		$newresult['comments']=$result;
		$newresult=array_merge($newresult,$uarray);
		return $newresult;
	}

	
	//$id is the id of the comment
	public function getComment ($id, $userid){
	//cookie_flags very necessary passes info back
		$this->Controller->set('cookie_flags',$this->Cookie->read('flagged_comments'));
		$CommentsUser=ClassRegistry::init('CommentsUser');
		$conditions=array('CommentsUser.comment_id'=>$id);
		$conditions['CommentsUser.user_id']=$userid;
		$ucomment=$CommentsUser->find('first',array(
			'conditions'=>$conditions,
			'recursive'=>0,
			'fields'=>array('CommentsUser.*')
		));
		$Comment=ClassRegistry::init('Comment');
		
		//this is problem on third one
		$comment=$Comment->find('threaded',array(
			'conditions'=>array('Comment.id'=>$id)
		));
		$result=array_merge($comment[0],$ucomment);
		return $result;
	}
	
	/* everything below this is OUTDATED! and shouldn't be used */
	
	//all this info is fetched in the first component now, don't need it
	public function userComment ($fk,$model, $userid){
		$Comment=ClassRegistry::init('Comment');
		$options['conditions']=array('Comment.foreign_key'=>$fk,'Comment.model'=>$model,'Comment.user_id'=>$userid,'Comment.parent_id is null');
		$options['recursive']=1;
		//should only return one record
		//no lots now with replies
		$result=$Comment->find('first',$options);
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
		
}