<?php
namespace Questions;
class Question {
    private int $id;
    private string $question;
    private array  $possibleQuestions;
    private string $type;

    /**
     * @param $id
     * @param $question
     * @param $correctAnswer
     * @param $type
     * @param array $possibleQuestion
     */
    public function __construct($id, $question, $correctAnswer, $type, array $possibleQuestion = [])
    {
        $this->id                   = $id;
        $this->question             = $question;
        $this->type                 = $type;
        $this->possibleQuestions    = $possibleQuestion;
    }
    public function render(): string{
        if($this->type === Questions::TYPE_INPUT){
            return $this->renderInput();
        }
        if($this->type === Questions::TYPE_DATE){
            return $this->renderDate();
        }
        if($this->type === Questions::TYPE_RADIO){
            return $this->renderRadio();
        }
        return $this->renderInput();
    }

    /**
     * @return string
     */
    private function renderDate(): string
    {
        return '<p>
            <label class="w3-text-grey">'.$this->question.'</label>
            <input class="w3-input w3-border" type="date" name="'.$this->id.'" required="">
        </p>';
    }

    /**
     * @return string
     */
    private function renderRadio(): string
    {
        $possibilities =  '';
        foreach ($this->possibleQuestions as $possibleQuestion){
            $possibilities .=   '<input  class="w3-radio" type="radio" name="'.$this->id.'" value="'.$possibleQuestion.'" required>
                                    <label>'.$possibleQuestion.'</label>
                                    <br>';
        }
        return '<p>
                    '.$this->question.'<br>
                      '.$possibilities.'
                    </p>';
    }

    /**
     * @return string
     */
    private function renderInput(): string
    {
        return '<p>
            <label class="w3-text-grey">'.$this->question.'</label>
            <input class="w3-input w3-border" type="text" name="'.$this->id.'" required="">
        </p>';
    }
}