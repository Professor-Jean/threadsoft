<?php

class MyMail{

  private $from = null;
  private $to = null;
  private $carbonCopy = array(); //vulgo cc;
  private $blindCarbonCopy = array(); //vulgo bcc
  private $reply = array();
  private $subject = "MyMail, Well Done";
  private $message = "Well Done, you send a e-mail with mymail! xD";
  private $headers = array();

  public function __construct(){
    $this->headers['mime'] = 'MIME-Version: 1.0';
    $this->headers['content'] = 'Content-type: text/html; charset=utf-8';
    $this->headers['xmailer'] = "X-Mailer: PHP/" . phpversion();
  }

  public function sendMail(){
    return mail($this->getTo(), $this->getSubject(), $this->getMessage(), $this->getHeaders());
  }

#G&S
  public function setTo($emails = array()){
    $this->to = implode(',', $emails);
  }

  private function getTo(){
    return $this->to;
  }

  public function setFrom($email){
    $this->from = $email;
    $this->headers['from'] = "From: " . $this->from;
  }

  private function getFrom(){
    return $this->from;
  }

  public function setSubject($subject){
    $this->subject = $subject;
  }

  private function getSubject(){
    return $this->subject;
  }

  public function setMessage($message){
    $this->message = $message;
  }

  private function getMessage(){
    return $this->message;
  }

  public function setReplies($replies = array()){
    $this->reply = "Reply-To: ";
    foreach($replies as $reply){
      $this->reply.=$reply.", ";
    }
    $this->reply = substr($this->reply, 0, -2);
    $this->headers['reply'] = $this->reply;
  }

  public function setCarbonCopies($carbonCopies){
    $this->carbonCopy = "CC: ";
    foreach($carbonCopies as $carbonCopy){
      $this->carbonCopy .= $carbonCopy.", ";
    }
    $this->carbonCopy = substr($this->carbonCopy, 0, -2);
    $this->headers['cc'] = $this->carbonCopy;
  }

  /*Alias to setCarbonCopies*/
  public function setCC($carbonCopies = array()){
    $this->setCarbonCopies($carbonCopies);
  }

  public function setBlindCarbonCopies($blindCarbonCopies = array()){
    $this->blindCarbonCopy = "BCC: ";
    foreach($blindCarbonCopies as $blindCarbonCopy){
      $this->blindCarbonCopy .= $blindCarbonCopy.", ";
    }
    $this->blindCarbonCopy = substr($this->blindCarbonCopy, 0, -2);
    $this->headers['bcc'] = $this->blindCarbonCopy;
  }
  /*Alias to setBlindCarbonCopies*/
  public function setBCC($blindCarbonCopies = array()){
    $this->setBlindCarbonCopies($blindCarbonCopies);
  }

  private function getHeaders(){
    return implode("\r\n", $this->headers);
  }
}
