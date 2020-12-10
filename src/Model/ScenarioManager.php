<?php

namespace App\Model;

class ScenarioManager extends AbstractManager
{

    private const TABLE = 'scenarios';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function save($name, $description, $realisedBy, $imageName)
    {
        $query = "INSERT INTO " . self::TABLE . " (name, description, realised_by, image_name)
        VALUES (:name, :description, :realised_by, :image_name)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':description', $description, \PDO::PARAM_STR);
        $statement->bindValue(':realised_by', $realisedBy, \PDO::PARAM_STR);
        $statement->bindValue(':image_name', $imageName, \PDO::PARAM_STR);
        $statement->execute();
        $id = $this->pdo->lastInsertId();
        return $id;
    }

    public function update($id, $name, $description, $realisedBy, $imageName)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET name = :name,
        description = :description, realised_by = :realised_by, image_name = :image_name WHERE id=:id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':description', $description, \PDO::PARAM_STR);
        $statement->bindValue(':realised_by', $realisedBy, \PDO::PARAM_STR);
        $statement->bindValue(':image_name', $imageName, \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function delete($id)
    {
        $scenarioDelete = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $scenarioDelete->bindValue(':id', $id, \PDO::PARAM_INT);
        $scenarioDelete->execute();
    }
}
