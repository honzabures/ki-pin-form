<?php
namespace Questions;
require 'Question.php';
class Questions {
    public const
        QUESTION    = 'question',
        ANSWER      = 'answer',
        TYPE        = 'type',
        TYPE_INPUT  =   'input',
        TYPE_RADIO  =   'radio-box',
        TYPE_DATE   =    'date',
        DIFFICULTY  = 'difficulty',
        DIFFICULTY_BEGINNER     = 'beginner',
        DIFFICULTY_ADVANCED     = 'advanced',
        DIFFICULTY_MASTER       = 'master',
        DIFFICULTY_LEVELS       = [
            1 => self::DIFFICULTY_BEGINNER,
            2 => self::DIFFICULTY_ADVANCED,
            3 => self::DIFFICULTY_MASTER,
        ];

    private array $questionArr = [
        self::DIFFICULTY_BEGINNER => [
            [
                'id'              => 1,
                'question'        => 'Do you have more than 70IQ',
                'correct_answer'  => 'Yes',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    'Yes','No','Maybe'
                ]
            ],
            [
                'id'              => 2,
                'question'        => '5+5',
                'correct_answer'  => '10',
                'type'            => 'input'
            ],
            [
                'id'              => 3,
                'question'        => 'Is Star Wars new triology better than the old one?',
                'correct_answer'  => 'No',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    'Yes','No'
                ]
            ],
            [
                'id'              => 4,
                'question'        => 'What is the most common back-end language.',
                'correct_answer'  => 'php',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    'php','javascript','c#'
                ]
            ]
        ],
        self::DIFFICULTY_ADVANCED => [
            [
                'id'              => 5,
                'question'        => 'What is the most known Czech PHP framework.',
                'correct_answer'  => 'Nette',
                'type'            => 'input'
            ],
            [
                'id'              => 7,
                'question'        => '10*10 = ',
                'correct_answer'  => '100',
                'type'            => 'input'
            ],
            [
                'id'              => 6,
                'question'        => 'What is NOT a framework.',
                'correct_answer'  => 'Python',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    'Python','node.js','Django'
                ]
            ],
            [
                'id'              => 8,
                'question'        => 'Is Cowboy Bebop best anime ever created ?',
                'correct_answer'  => 'Yes',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    'Yes'
                ]
            ],
        ],
        self::DIFFICULTY_MASTER => [
            [
                'id'              => 10,
                'question'        => 'When its my birthday date.',
                'correct_answer'  => '1999-02-13',
                'type'            => 'date'
            ],
            [
                'id'              => 11,
                'question'        => 'How many minutes in a game of rugby league?.',
                'correct_answer'  => '80 minutes',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    '80 minutes','90 minutes','120 minutes'
                ]

            ],
            [
                'id'              => 12,
                'question'        => 'Which planet is closest to the sun?',
                'correct_answer'  => 'Mercury',
                'type'            => 'radio-box',
                'possible_answers'=> [
                    'Mars','Venus','Mercury'
                ]
            ],
            [
                'id'              => 13,
                'question'        => 'Who painted the Mona Lisa?',
                'correct_answer'  => 'Leonardo da Vinci',
                'type'            => 'input'
            ],
        ]
    ];

    /**
     * @param $difficulty
     * @return array
     */
    public function getDifficultyQuestions($difficulty) : array
    {
        $questions = [];
        foreach ($this->questionArr[$difficulty] as $question) {
            $questions[] = new Question(
                $question['id'],
                $question['question'],
                $question['correct_answer'],
                $question['type'],
                $question['possible_answers'] ?? []);
        }
        return $questions;
    }

    /**
     * @param $answer
     * @param $questionId
     * @param $difficulty
     * @return bool
     */
    public function verifyAnswer($answer, $questionId, $difficulty): bool
    {
        foreach ($this->questionArr[$difficulty] as $question){
            if($question['id'] === $questionId){
                return $answer === $question['correct_answer'];
            }
        }
        return false;
    }
}