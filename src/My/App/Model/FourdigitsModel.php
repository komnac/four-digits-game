<?php

namespace My\App\Model;

use My\App\Database\Connection as DBConnection;
use My\Game\FourDigitsQuizGenerator;


class FourdigitsModel {
    private $phone;
    private $db;

    public function __construct($phone)
    {
        if (!ctype_digit($phone)) {
            throw new \InvalidArgumentException('Телефон может состоять только из цифр');
        }

        $this->phone = $phone;
        $this->db = DBConnection::getInstance();
    }

    /**
     * Find unfinished game.
     *
     * @return bool|FourdigitsGame return FALSE if no game found, FourdigitsGame otherwise
     *
     * @throws \My\App\Database\Exception
     */
    public function findGame()
    {
        $queryResult = $this->db->query(
            sprintf(
                'SELECT * FROM games WHERE is_finished = 0 AND phone_number = "%s" LIMIT 1',
                $this->db->escape_string($this->phone)
            )
        );

        if ($queryResult->num_rows != 1) {
            return false;
        }

        return new FourdigitsGame($queryResult->fetch_object());
    }

    /**
     * Create a new Four Digit Game
     *
     * @return FourdigitsGame
     *
     * @throws \My\App\Database\Exception
     */
    public function newGame()
    {
        $quizGenerator = new FourDigitsQuizGenerator();
        $quiz = $quizGenerator->generate();

        $this->db->query(
            sprintf(
                'INSERT INTO games (phone_number, quest) VALUES ("%s", "%s")',
                $this->db->escape_string($this->phone),
                $this->db->escape_string($quiz->getQuestWord())
            )
        );

        $queryResult = $this->db->query(
            sprintf(
                'SELECT * FROM games WHERE id = %u LIMIT 1',
                (int) $this->db->insert_id
            )
        );

        return new FourdigitsGame($queryResult->fetch_object());
    }
}