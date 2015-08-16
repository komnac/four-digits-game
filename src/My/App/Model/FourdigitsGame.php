<?php

namespace My\App\Model;

use My\App\Database\Connection as DBConnection;
use My\Game\Quiz;

class FourdigitsGame {
    private $db;
    private $game;
    private $quiz;

    public function __construct(\stdClass $game)
    {
        $this->game = $game;
        $this->db   = DBConnection::getInstance();
        $this->quiz = new Quiz($game->quest);
    }

    /**
     * Play a game.
     *
     * @param $answer   trying answer
     * @return bool     TRUE if win; FALSE otherwise
     */
    public function play($answer)
    {
        if (empty($answer)) {
            return false;
        }

        $result = $this->quiz->match($answer);
        $this->writeAnswer($result->getAnswer());

        if (!$result->isFullMatched()) {
            return false;
        }

        $this->finish();

        return true;
    }

    /**
     * Return answers history.
     *
     * @return array
     */
    public function getHistory()
    {
        $queryResult = $this->db->query(
            sprintf(
                'SELECT * FROM answers WHERE game_id = %u ORDER BY answer_time',
                $this->game->id
            )
        );

        $history = [];
        while ($row = $queryResult->fetch_assoc()) {
            $history[] = (string) $this->quiz->match($row['answer']);
        }

        return $history;
    }

    private function writeAnswer($answer)
    {
        $this->db->query(
            sprintf(
                'INSERT INTO answers (game_id, answer) VALUES (%u, "%s")',
                (int) $this->game->id,
                $this->db->escape_string($answer)
            )
        );
    }

    private function finish()
    {
        $this->db->query(
            sprintf(
                'UPDATE games SET is_finished = 1 WHERE id = %u',
                (int) $this->game->id
            )
        );
    }
}