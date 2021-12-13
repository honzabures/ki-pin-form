<?php
use Form\Form;
use Scoreboard\Scoreboard;
require 'Form/Form.php';
require 'Scoreboard/Scoreboard.php';
$form             = new Form();
$scoreboard       = new Scoreboard();
$lastFormStatus   = null;
if(isset($_POST['quiz'])){
    $lastFormStatus = $form->verify($_POST);
}
$questions = $form->generate();
?>
<html lang="">
    <title>Jan Bureš | Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <body class="w3-light-grey">
        <div class="w3-container w3-teal" style="padding-bottom:20px;">
            <h1>Jan Bureš | Forms</h1>
        </div>
        <div class="w3-content w3-margin-top" style="max-width:1400px;">
            <div class="w3-row-padding">
                <div class="w3-threethird">
                    <div class="w3-container">
                        <form class="w3-container w3-card-4" action="index.php" method="post">
                            <?php
                                if($lastFormStatus){
                                    echo ' <h2  style="color:green;text-align: center;"><b>Úspěšně jste odpověděli na poslední test. Proto nyní dostanente těžší verzi!</b></h2>';
                                }else if (!$lastFormStatus){
                                    echo ' <h2  style="color:red;text-align: center;"><b>Neúspěšně jste odpověděli na poslední test. Proto nyní dostanente lehčí verzi!</b></h2>';
                                }
                            ?>
                            <br>
                            <p>
                                <input class="w3-input w3-border" type="text" value="<?php echo $_COOKIE['player_name'] ?? null ?>" name="player_name" required placeholder="Player Name">
                            </p>
                            <hr/>
                            <?php
                                foreach ($questions as $question){
                                    echo $question->render();
                                }
                            ?>
                            <p><button type="submit" name="quiz" class="w3-btn w3-padding w3-teal" style="width:120px">Answer &nbsp; ❯</button></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w3-row-padding">
                <div class="w3-threethird">
                    <div class="w3-container">
                            <table class="w3-table-all">
                                <tr>
                                    <th>Name</th>
                                    <th>Score</th>
                                    <th>Difficulty</th>
                                </tr>
                                <?php
                                    $restOfTable = '';
                                    foreach ($scoreboard->getScores() as $score){
                                        $restOfTable .= '<tr><td>'.$score['name'].'</td><td>'.$score['points'].'</td><td>'.$score['difficulty'].'</td></tr>';
                                    }
                                    echo $restOfTable;
                                ?>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </body>
</html>
