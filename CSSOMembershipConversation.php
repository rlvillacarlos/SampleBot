<?php

require_once './vendor/autoload.php';
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
/**
 * Description of CSSOMembershipConversation
 *
 * @author russel
 */
class CSSOMembershipConversation extends Conversation{
    protected $name;
    
    public function askName() {
        $this->ask("What is your name?", function(Answer $answer){
            $this->name = $answer->getText();
            $this->say("Hello ". $this->name);   
            $this->askBeAMember();
        });
    }
    
    public function askBeAMember(){
        $question = Question::create("Do you want to be a member of CSSO?")
                    ->addButton(Button::create("Yes")->value("y"))
                    ->addButton(Button::create("No")->value("n"));
        
        $this->ask($question, function(Answer $answer){
            $continue = $answer->getValue();
            
            if($continue==='y'){
                $this->askCourse();
            }else if($continue==='n'){
                $this->say("Nice meeting you " .$this->name.". Goodbye!");
            }
            
        });
    }
    
    public function askCourse() {
        $question = Question::create("Are you a BS Computer Science student?")
                    ->addButton(Button::create("Yes")->value("y"))
                    ->addButton(Button::create("No")->value("n"));
        
        $this->ask($question, function(Answer $answer){
            $continue = $answer->getValue();
            
            if($continue==='y'){
                $this->say("You are one of us! Welcome to CSSO");
            }else if($continue==='n'){
                $this->say("Too bad CSSO is an academic organization open only for BS Computer Science students");
            }
            
        });
    }
    public function run(){
        $this->askName();
    }
}
