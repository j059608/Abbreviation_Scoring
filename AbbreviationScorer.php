<?php

class AbbreviationScorer{

  var $toscore;
  var $td;


/**
 * constructor
 */
  function __construct($to_score){
    $this->to_score = $to_score;
    $this->td = strtolower($this->to_score);
  }

  function compute($abbreviation){
    if(strlen($abbreviation) == 0){
      return 0.9;
    }

    if(strlen($this->to_score) < strlen($abbreviation) ){
      return 0;
    }
    
    $ad = strtolower($abbreviation);
    
    for($i = 0;$i < strlen($ad);$i++){
        $this->score_for($ad,strlen($ad) - $i);
      if($i == strlen($ad)){
          return 0;
      }
    }
  }
  
  // return score 
  function score_for($abbreviation,$pivot)
  {
    // TODO correct?
      $pivot = 0;
      $ahead = substr($abbreviation,$pivot,1);
    
      for($i = 0;$i < strlen($abbreviation);$i++){
          $atail = $abbreviation[$i];
      }
      $found = strpos($this->td,$ahead,$pivot);
      $this->dp($found,'found');
      if(strlen($found) == 0){
          return false;
      }

      $this->dp();
      
      $count = strpos($this->to_score,$found + $pivot,1);
      $this->dp($count,"count");
      for($i = 0;$i < $count;$i++)
          {
              $temp = substr($this->to_score,$i,1);
              if(strlen($temp) > 0){
                  $tail = $temp;
                  $this->dp($tail,'tail');
                  // compute score previous result.
                  #              $objTemp = new AbbreviationScorer($tail);	  
                  #              $tail_score = $objTemp->compute($atail);
                  if(strlen($tail_score) == 0){
                      return false;
                  }
                  // TODO compute penalty
                  $point = ($found + $pivot) ;
                  return ($point + $tail_score * strlen($tail))/strlen($this->to_score);
              }
          }
  }// end of function score_for.
  
  function dp($str , $var_name = ""){
      if ($var_name) {
          echo $var_name.":";
      }
      var_dump($str);
  }
  
  }// end of class.

$obj = new AbbreviationScorer("test");
echo $obj->compute("e");