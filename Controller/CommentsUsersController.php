<?php
App::uses('AppController', 'Controller');
class CommentsUsersController extends AppController {
	public $components = array('Paginator','Comment');
	public function beforeFilter() {
		parent::beforeFilter();
		//take notes of 
		if ($this->Auth->user()){
			//$this->user=$this->Auth->user();
		}
	//	$this->Security->blackHoleCallback = 'blackhole';
	}
	public function blackhole($type) {
		//debug($type);
		$this->Session->setFlash('CommentsUsers: '.$type,'flash_custom');
	}
	
	public function beforeRender() {
		if (isset($this->growl)) $this->set('growl',$this->growl);
	}
	
	public function afterFilter() {
		
	}
	
	
	//$parent is comment ID
	public function comment_reply($parent,$model,$fk){
	$comment=$this->CommentsUser->Comment->find('first',array('conditions'=>array('Comment.id'=>$parent)));
	if ($this->Auth->user()){
		$user=$this->CommentsUser->User->find('first',array(
					'conditions'=>array('User.id'=>$this->Auth->user('id')),
					'recursive'=>-1	
				));
		$user=$user['User'];
		
		//make sure not replying to oneself
		if ($comment['Comment']['user_id']!=$user['id'] && !empty($this->request->data[$parent]['reply'.$parent])){
			if (isset($this->request->data[$parent]['reply_id'])) $data['id']=$this->request->data[$parent]['reply_id'];
			$data['user_id']=$user['id'];
			$data['parent_id']=$parent;
			$data['ip']=$_SERVER['REMOTE_ADDR'];
			$data['hidden']=0;
			$data['thoughts']=$this->request->data[$parent]['reply'.$parent];
			$data['foreign_key']=$this->request->data[$parent]['foreign_key'];
			$data['model']=$this->request->data[$parent]['model'];
			
			if ($this->CommentsUser->Comment->save($data)){
				//$this->Session->setFlash('Your reply was saved','flash_growl_success',array(),'commentFlash');
				$growl['type']='success';
				$growl['msg']='Your reply was saved';
				//$tree=$this->CommentsUser->Comment->find('threaded',array('conditions'=>array()));
			}
		}
		else if (empty($this->request->data[$parent]['reply'.$parent])){
//			$this->Session->setFlash('Reply box is empty','flash_warning',array(),'commentFlash');
			$growl['type']='warning';
			$growl['msg']='Reply box is empty';
		}
		else {
			//$this->Session->setFlash('There has been an error. Try again or give up.','flash_danger',array(),'commentFlash');
			$growl['type']='danger';
			$growl['msg']='There has been an error. Try again or give up.';
		}
	}
	else {
		$user='';
		$growl['type']='danger';
		$growl['msg']='You must be logged in to reply';
		//$this->Session->setFlash('You must be logged in to reply','flash_custom',array(),'commentFlash');
	}
		
		$comments=$this->Comment->getComments($fk,$model,$user['id']);
		$this->set(compact('comment','comments','user','model','fk'));
		if (isset($growl)) $this->set('growl',$growl);
		$this->render('comment_add','ajax');
	}
	//$id is the id of the Comment
	//$flag is whether to flag or unflag (1, -1, reveal)
	public function comment_flag($id,$model,$fk) {
		$user=$this->Auth->user();
		if ($this->request->is('post')){
			if (isset($user['id'])){
				$flag=0;
				if ($this->request->data[$id]['pflag']=='flag') $flag=1;
				if ($this->request->data[$id]['pflag']=='unflag') $flag=-1;
				//find the user for proper flag totals
				$user=$this->CommentsUser->User->find('first',array(
					'conditions'=>array('User.id'=>$this->Auth->user('id')),
					'recursive'=>-1	
				));
				$user=$user['User'];
				//first do the flag totals, no need for IF statement as its just a tally for the user
				if ($flag==1){
					$userdata['id']=$user['id'];
					$userdata['flags']=$user['flags'];
					$userdata['flags']++;
					if ($this->CommentsUser->User->save($userdata));
				}
				$commentsuser=$this->CommentsUser->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('CommentsUser.comment_id'=>$id,'CommentsUser.user_id'=>$user['id'])
				));
				$this->CommentsUser->create();
				if (isset($commentsuser['CommentsUser']['id'])){
					$data['id']=$commentsuser['CommentsUser']['id'];
					//do nothing if same choice
					if ($commentsuser['CommentsUser']['flagged'] == true && $flag==1) return true;
					if ($commentsuser['CommentsUser']['flagged'] == false && $flag==-1) return true;
				}
				$data['user_id']=$user['id'];
				$data['comment_id']=$id;
				if ($this->request->data[$id]['pflag']=='flag') $data['flagged']=true;
				if ($this->request->data[$id]['pflag']=='unflag') $data['flagged']=false;
				if ($this->CommentsUser->save($data)){
				
					$this->CommentsUser->Comment->create();
					$commentdata=$this->CommentsUser->Comment->find('first',array(
						'conditions'=>array('Comment.id'=>$id),
						'recursive'=>-1
					));
					//only do math on Comment if its a NEW flag or the same user unflagging
					if ((isset($commentsuser['CommentsUser']['id']) && $flag==-1) || ($flag==1)){
						$commentdata['Comment']['flags']=$commentdata['Comment']['flags']+$flag;
					}
					if ($this->CommentsUser->Comment->save($commentdata)){
						$growl['type']='warning';
						$growl['msg']='Comment flagged';
					}
				}
			}
			else {
				$growl['type']='warning';
				$growl['msg']='Create an account to permanently flag and unflag comments.';
				$this->growl=$growl;
				//makes a cookie for flagged comments, this is read and set from CommentComponent
				$cookie=$this->Cookie->read('flagged_comments');
				if ($this->request->data[$id]['pflag']=='flag') $cookie[$id]=true;
				if ($this->request->data[$id]['pflag']=='unflag') unset($cookie[$id]);
				$this->Cookie->write('flagged_comments',$cookie, false, '1 year');
				$user['id']=null;
			}
			$comment=$this->Comment->getComment($id,$this->Auth->user('id'));
			if ($this->request->data[$id]['pflag']=='reveal') $this->set('reveal',true);
			$this->set(compact('comment','user','model','fk'));
			if (isset($growl)) $this->set('growl',$growl);
			$this->render('comment_single','ajax');
		}
			
	}
	
	//$fk is foreign_key
	public function comment_add($parentid=null) {
	//may want to strip HTML tags at some point
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				//first see if this is an existing comment
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('Comment.foreign_key'=>$this->request->data['sComment']['foreign_key'],'Comment.model'=>$this->request->data['sComment']['model'],'Comment.user_id'=>$user['id'],'Comment.parent_id is null')
				));
				if (isset($commentdata['Comment']['id'])){
					$comment['id']=$commentdata['Comment']['id'];
					$noted='updated';
				}
				else {
					$this->CommentsUser->Comment->create();
					$noted='added';
				}
				
				$comment['thoughts']=$this->request->data['sComment']['comment'];
				if (isset($comment['rating'])) $comment['rating']=$this->request->data['sComment']['rating'];
				$comment['user_id']=$user['id'];
				$fk=$this->request->data['sComment']['foreign_key'];
				$comment['foreign_key']=$fk;
				$model=$this->request->data['sComment']['model'];
				$comment['model']=$model;
				$comment['hidden']=0;
				$comment['ip']=$_SERVER['REMOTE_ADDR'];
				if (isset($parentid)) $comment['parent_id']=$parentid;
				if ($this->CommentsUser->Comment->save($comment)){
					$growl['type']='success';
					$growl['msg']='Your comment was '.$noted;	
				}
			}
			else {
				$growl['type']='danger';
				$growl['msg']='You must be logged in to add comments';
				$user['id']=null;
			}
			//Comment component..
			$comments=$this->Comment->getComments($fk,$model,$user['id']);
			$this->set(compact('comment','comments','user','model','fk'));
			if (isset($growl)) $this->set('growl',$growl);
			$this->render('comment_add','ajax');
			
		//}
	}	
	
	//this upvotes and downvotes
	//$id is the comment id
	public function comment_up($id, $vote,$model,$fk) {
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
	/*
			The important thing to note here is that there are THREE saves, in this order:
			$data is the CommentsUser data
			$commentdata is the Comment data ( just upvote and downvote tally right now)
			$votedata is the User vote tally, here we just track their grand total (it never subtracts)
			(hopefully all this painful counting will be worth it someday)
	
	*/
				//find the user rather than first method for proper vote totals
				//$user=$this->Auth->user();
				$user=$this->CommentsUser->User->find('first',array(
					'conditions'=>array('User.id'=>$this->Auth->user('id')),
					'recursive'=>-1	
				));
				$user=$user['User'];
				$data['user_id']=$this->Auth->user('id');
				$data['comment_id']=$id;
				$commentuser=$this->CommentsUser->find('first',array(
					'conditions'=>array('CommentsUser.comment_id'=>$id,'CommentsUser.user_id'=>$this->Auth->user('id')),
					'recursive'=>-1
				));
				if (isset($commentuser['CommentsUser']['id'])) $data['id']=$commentuser['CommentsUser']['id'];
				else $this->CommentsUser->create();
				$commentdata=$this->CommentsUser->Comment->find('first',array(
				'recursive'=>-1,
				'conditions'=>array('Comment.id'=>$id)
				));
					if (isset($commentdata['Comment']['id'])) $commentdata['Comment']['id']=$id;
					else $this->CommentsUser->Comment->create();
					
				//first save user totals, they are simply cumulative
				$votedata['id']=$this->Auth->user('id');
				if ($vote==1){
					$votedata['upvotes']=$user['upvotes'];
					$votedata['upvotes']++;
				}
				if ($vote==-1){
					$votedata['downvotes']=$user['downvotes'];
					$votedata['downvotes']++;
				}
					if ($this->CommentsUser->User->save($votedata,array('validate' => false)));
					
				if(!empty($commentuser)){
					if ($vote==1 && $commentuser['CommentsUser']['upvoted']!=true){
						//$data['id']=$commentuser['CommentsUser']['id'];
						//means we're reversing direction
						if ($commentuser['CommentsUser']['downvoted']==true){
							$data['upvoted']=false;
							$data['downvoted']=false;
							$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']-1;
							//$votedata['downvotes']=$votedata['downvotes']+1;
						}
						else {
							$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
							$votedata['upvotes']=$votedata['upvotes']+1;
							unset($commentdata['Comment']['downvotes']);
							$data['upvoted']=true;
						}
					}
					else if ($vote==-1 && $commentuser['CommentsUser']['downvoted']!=true){
						//$data['id']=$commentuser['CommentsUser']['id'];
							if ($commentuser['CommentsUser']['upvoted']==true){
								$data['upvoted']=false;
								$data['downvoted']=false;
								$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']-1;
								//$votedata['upvotes']=$votedata['upvotes']+1;
							}
							else {
								$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;
								//$votedata['downvotes']=$votedata['downvotes']+1;
								unset($commentdata['Comment']['upvotes']);
								//unset($votedata['upvotes']);
								$data['downvoted']=true;
							}
					}
					else {
						//they have already voted this way or something else is wrong
						return false;
					}
				}
				//comment is empty
				else {
					if ($vote==1){ 
						$data['upvoted']=true;
						$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
						unset($commentdata['Comment']['downvotes']);
					}
					if ($vote==-1){
						$data['downvoted']=1;
						$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;
						unset($commentdata['Comment']['upvotes']);
					}
				}
				if($this->CommentsUser->save($data)){
					//update the actual comment with the new total
					if ($this->CommentsUser->Comment->save($commentdata['Comment'])){
						//run a quick query to update the difference
						$db = ConnectionManager::getDataSource('default');
						$db->rawQuery('update comments set diff=ifnull(upvotes,0)-ifnull(downvotes,0);');
					}
				}
					
			}
			else {
				//$this->Session->setFlash('You must be logged in to upvote and downvote.','flash_custom',array(),'commentFlash');
				$growl['type']='warning';
				$growl['msg']='You must be logged in to vote';
				$user['id']=null;
			}
			//return only the single comment
			$comment=$this->Comment->getComment($id,$user['id']);
			$this->set(compact('comment','user','model','fk'));
			if (isset($growl)) $this->set('growl',$growl);
			$this->render('comment_single','ajax');
		//}
	
	}
	
	//$id is the id of the comment
	public function comment_hide($id,$model,$fk,$parentid=null) {
	//be sure to turn this on in production
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				//first see if this is an existing comment and that it matches the logged in user
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>1,
					'conditions'=>array('Comment.id'=>$id,'Comment.user_id'=>$user['id'])
				));
				if (isset($commentdata['Comment']['id'])){
					$commentdata['Comment']['hidden']=1;
					$this->CommentsUser->Comment->create();
					if ($this->CommentsUser->Comment->save($commentdata)){
						//$this->Session->setFlash('Comment hidden. Feel free to update and resubmit.','flash_custom',array(),'commentFlash');
						$growl['type']='success';
						$growl['msg']='Your comment was hidden, feel free to resubmit';
						
					}
					else {
						$growl['type']='danger';
						$growl['msg']='Something went very bad';
						//$this->Session->setFlash('Something went very bad.','flash_danger');
					}
				}
				else {
					$growl['type']='danger';
					$growl['msg']='Something went really bad';
					//$this->Session->setFlash('Another bad thing.','flash_danger');
					return true;
				}
				
			}
			else {
				$growl['type']='danger';
				$growl['msg']='Account mismatch. Try refreshing the page';
				//$this->Session->setFlash('account mismatch','flash_custom',array(),'commentFlash');
				$user['id']=null;
			}
			$comments=$this->Comment->getComments($fk,$model,$user['id']);
			if (isset($growl)) $this->set('growl',$growl);
			$this->set(compact('comments','user','model','fk'));
			$this->render('comment_add','ajax');
		//}
	}	
}

