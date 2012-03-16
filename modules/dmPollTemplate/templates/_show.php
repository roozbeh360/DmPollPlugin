<?php // Vars: $dmPollTemplate


 
$arr = explode(',', $dmPollTemplate->getAnswers());
 
if($sf_user->getFlash('poll_form'))
	echo __('Thanks for your opinion')."<br />" ;
 
	if($sf_user->hasAttribute('showPollResult')){
	 
		$result= array();
	 
		$obj=$sf_user->getAttribute('showPollResult');
	 	$pollTotalResult = count($obj);
	 		foreach($obj as $key=>$value)
	 			if(!in_array($value->answer, $result)){
	 				array_push($result,"$value->answer");
	 				$result[$value->answer]=1;
	 
					}
	 else $result["$value->answer"] = (int)($result[(string)$value->answer])+1 ;
	 
	 $counter = 0 ;
	 
	 echo _open('div#dmpollresult');
	 echo _tag('label',$dmPollTemplate->getQuestion()).'<br />',
	  _tag('label',__('Total votes')).' : '.$pollTotalResult.'<br />' ;
	  
	 
	 	foreach ($result as $key=>$showPollvalues)
	 		if(is_string($key)){
	 			$couunter = $counter+1;
	 			echo $couunter.'. '._tag('label',$key).'<br />',
 						'<div style="width:98%; padding: 5px" >',
						__('Vote').':'.$showPollvalues.'
						'.'     '.substr(((string)($showPollvalues*100)/$pollTotalResult),0,4)."%",
 						'<div  class="pollresult"
						style="width:'.((int)($showPollvalues*100)/$pollTotalResult).'%"
						></div>',
 						'</div>'
 						;
	 			}			
	 
	echo _close('div');
 
	}
	else{
		echo '<form method="post" >',
		     _tag('label',$dmPollTemplate->getQuestion()),
			 '<input type="hidden" name="pollid" value="'.$DmpollId.'">';
		 
			foreach($arr as $value){
		 
				echo '<br />'.'<input type="radio" name="pollselect"
				value="'.$value.'" />'.$value;
				}
		
		echo '<br />',
				'<input type="submit" value="'.__('Send').'">',
		 		'</form>';
		 
		
	}
 