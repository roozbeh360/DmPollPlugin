<?php
/**
 * Dm poll template actions
 */
class dmPollTemplateActions extends myFrontModuleActions
{
	
public function current_url_cheeck(){
	$chek = false;
	(!isset($_SERVER['HTTP_REFERER'])) ? $chek=false : $chek= TRUE;
	if($chek){
       if($_SERVER['HTTP_REFERER']=== (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']) 
	   $chek = true;
	   else $chek = false ;
	}
	return $chek;   
	 
}
public function executeShowWidget(dmWebRequest $request)
 {

 




 
if ($request->hasParameter('pollid') && $request->hasParameter('pollselect') && $this->current_url_cheeck() )
 {
 	$__CheckPoll = DmPollTemplateTable::getInstance()->findOneById((int)$request->getParameter('pollid')) ;
	
if(!$__CheckPoll || !in_array($request->getParameter('pollselect'), explode(',', $__CheckPoll->answers))) 
		$this->redirectBack()
		 ;	
	
 // form->save();
 $Dmpollresult = new DmPollResults();
 $Dmpollresult->question = $request->getParameter('pollid') ;
 $Dmpollresult->answer = $request->getParameter('pollselect');
 $Dmpollresult->save();
 $this->getUser()->setFlash('poll_form',true ) ;
  // form->save();

// poll result show
 
 $pollCount = array();
 
 $pollCount = DmPollResultsTable::getInstance()
 				->createQuery('c')
 				->where('c.question=?',$request->getParameter('pollid'))
 				->andWhere('c.culture=?',$this->getUser()->getCulture())
				->execute();
				
 $this->getUser()->setAttribute('showPollResult', $pollCount);
 
 //end poll result show
 
$this->redirectBack();
 }
 

 
}
 


}
 



