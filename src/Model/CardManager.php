<?php

namespace App\Model;

class CardManager extends AbstractManager
{
    private const TABLE = 'cards';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllByScenario($scenarioId): array
    {
        $query = ('SELECT * FROM ' . self::TABLE . ' where scenario_id=:scenario_id');
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':scenario_id', $scenarioId, \PDO::PARAM_INT);
        $statement->execute();
        $cards = $statement->fetchAll();

        return $cards;
    }

    public function save($name, $text, $cardNumber, $scenarioId, $imageName)
    {
        $query = "INSERT INTO " . self::TABLE . " (name, text, card_number, scenario_id, image_name)
        VALUES (:name, :text, :card_number, :scenario_id, :image_name)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':text', $text, \PDO::PARAM_STR);
        $statement->bindValue(':card_number', $cardNumber, \PDO::PARAM_INT);
        $statement->bindValue(':scenario_id', $scenarioId, \PDO::PARAM_INT);
        $statement->bindValue(':image_name', $imageName, \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function update($id, $name, $text, $cardNumber, $imageName)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET name = :name,
        text = :text, card_number = :card_number, image_name = :image_name WHERE id=:id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':text', $text, \PDO::PARAM_STR);
        $statement->bindValue(':card_number', $cardNumber, \PDO::PARAM_INT);
        $statement->bindValue(':image_name', $imageName, \PDO::PARAM_STR);
        return $statement->execute();
    }
}
