<?php
/**
 * Dm poll template components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class dmPollTemplateComponents extends myFrontModuleComponents
{

  public function executeShow()
  {
    $query = $this->getShowQuery();
    
    $this->dmPollTemplate = $this->getRecord($query);
	$this->DmpollId = $this->dmPollTemplate->getId();
	//$this->form = $this->forms['getHold'] ;
  }


}
