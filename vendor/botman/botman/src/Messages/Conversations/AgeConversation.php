<?php

namespace BotMan\BotMan\Messages\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class AgeConversation extends Conversation
{
    protected $age;

    public function hello()
    {
        $this->say('Cześć, '. $this->bot->getUser()->getFirstName() . '.');
        
        $this->askAge();
    }

    public function askAge()
    {
        $this->ask('Ile masz lat?', function(Answer $answer) {
            // Save result
            $this->age = $answer->getText();
            
            $this->checkAge();
        });
    }
    
    public function checkAge()
    {
        if($this->age < 13 || $this->age > 100) {
            $this->ask('Prosze o podanie wieku w zakresie od 13 do 100', function(Answer $answer) {
                $this->age = $answer->getText();
                $this->checkAge();
            });
        } else {
            $this->askYear();
        }
    }
    
    public function askYear()
    {
        $year = date('Y') - $this->age;
        $question = Question::create('Dziękuję. Twój rok urodzenia to '.$year.'?')->addButtons([
            Button::create('Tak')->value('tak'),
            Button::create('Nie')->value('nie'),
        ]);
        
        $this->ask($question, function(Answer $answer) {
            if($answer->getValue() === 'tak') {
                $this->ask('Świetnie. Dziękuję za odpowiedź.', function(Answer $answer) {
                    if(preg_match('/.*/', $answer->getText())) {
                        $this->hello();
                    }
                });
            } elseif($answer->getValue() === 'nie') {
                $this->askAge();
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->hello();
    }
}