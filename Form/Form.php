<?php
namespace Form;
//Could be replaced with autoloader :-)
require_once __DIR__.'/../Database/SQL.php';
require __DIR__.'/../Questions/Questions.php';

use Database\SQL;
use Questions\Questions;
class Form extends SQL {
    private const
        TOTAL_QUESTIONS     = 4,
        STARTING_POINTS     = 0;

    /** @var Questions  */
    private Questions $questions;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->questions = new Questions();
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        $difficulty                         = $_SESSION[Questions::DIFFICULTY] ?? Questions::DIFFICULTY_BEGINNER;
        $_SESSION[Questions::DIFFICULTY]    = $difficulty;
        return $this->questions->getDifficultyQuestions($difficulty);
    }

    /**
     * @param $answers
     * @return bool
     */
    public function verify($answers) : bool{
        $points = self::STARTING_POINTS;
        foreach ($answers as $key => $value){
            $isKeyValid = $key !== 'player_name' && $key !== 'quiz';
            if($isKeyValid && $this->questions->verifyAnswer($value, $key, $_SESSION[Questions::DIFFICULTY] ?? Questions::DIFFICULTY_BEGINNER)) {
                $points++;
            }
        }
        $_COOKIE['player_name']    = $answers['player_name'];
        if(!empty($answers['player_name']) && !empty($points) && !empty($_SESSION[Questions::DIFFICULTY])){
            $this->insertScore($answers['player_name'],$points ,$_SESSION[Questions::DIFFICULTY]);
        }
        $this->storeDifficulty($points);
        return self::TOTAL_QUESTIONS / 2 < $points;
    }

    /**
     * @param $points
     */
    private function storeDifficulty($points) : void
    {
        $currentLevel = array_search($_SESSION[Questions::DIFFICULTY], Questions::DIFFICULTY_LEVELS, true);
        if(!$currentLevel){
            $currentLevel = 2;
        }
        if(self::TOTAL_QUESTIONS/2 < $points && $currentLevel !== count(Questions::DIFFICULTY_LEVELS)){
            $newLevel = Questions::DIFFICULTY_LEVELS[$currentLevel+1];
            $_SESSION[Questions::DIFFICULTY] = $newLevel;
        }else if ($currentLevel !== 1){
            $newLevel = Questions::DIFFICULTY_LEVELS[$currentLevel-1];
            $_SESSION[Questions::DIFFICULTY] = $newLevel;
        }
    }

    /**
     * @param $name
     * @param $points
     * @param $difficulty
     */
    private function insertScore($name,$points,$difficulty) : void{
        $sql = 'INSERT INTO score (points, name ,difficulty)
                VALUES ('.(int) $points.',"'.$name.'","'.$difficulty.'")';
        $this->insert($sql);
    }
}