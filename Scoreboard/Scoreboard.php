<?php
namespace Scoreboard;
require_once __DIR__.'/../Database/SQL.php';
use Database\SQL;
class Scoreboard extends SQL {

    /**
     * @return array
     */
    public function getScores() : array
    {
        $scores =  [];
        $sql    = 'SELECT name,points,difficulty FROM score ORDER BY points DESC';
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $scores[] = [
                    'name'          => $row['name'],
                    'points'        => $row['points'],
                    'difficulty'    => $row['difficulty'],
                ];
            }
        }
        return $scores;
    }
}