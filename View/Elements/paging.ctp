<?
$controller = $this->name;
$model = trim($controller , "s");
if ($this->request->action=='view' && $model='Usergal') $model='TreasuresUsergal';
if ($this->request->paging[$model]['pageCount']>1):?>
<div class="row allcaps">
<div class="col-md-12">
<ul class="pagination">
<?

//this is the way to do it with Bootstrap, probably will make this an element 
		echo $this->Paginator->prev('<<', array('tag'=>'li'), null, array('class' => 'prev disabled','escape'=>'false','tag'=>'li','disabledTag'=>'a'));
		//notice class names, there is a special one for "xs" view - NOT anymore
		echo $this->Paginator->numbers(array('currentTag'=>'a','currentClass'=>'active','separator' => '','tag'=>'li','before'=>'','after'=>'','modulus'=>13,'class'=>''));
		//echo $this->Paginator->numbers(array('currentTag'=>'a','currentClass'=>'active','separator' => '','tag'=>'li','before'=>'','after'=>'','modulus'=>6,'class'=>'visible-xs-inline'));
		echo $this->Paginator->next('>>', array('tag'=>'li'), null, array('class' => 'next disabled','escape'=>'false','tag'=>'li','disabledTag'=>'a'));
?>
</ul>
</div>
</div>
<?endif?>