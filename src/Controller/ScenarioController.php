<?php

namespace App\Controller;

use App\Model\ScenarioManager;
use App\Model\CardManager;

class ScenarioController extends AbstractController
{
    public function browse()
    {
        $scenarioManager = new ScenarioManager();
        $scenarios = $scenarioManager->selectAll();

        return $this->twig->render('Scenario/browse.html.twig', ['scenarios' => $scenarios]);
    }

    public function show(int $scenarioId)
    {
        $cardManager = new CardManager();
        $cards = $cardManager->selectAllByScenario($scenarioId);
        if (!isset($_SESSION['game']) || ($scenarioId !== ($_SESSION['scenarioId']))) {
            $_SESSION['game'] = [
                'board' => [1],
                'graveyard' => []
            ];
            $_SESSION['scenarioId'] = $scenarioId;
        }

        $boardCards = [];
        $board = $_SESSION['game']['board'];

        $boardCards = array_filter(
            $cards,
            function ($card) use ($board) {
                return in_array(
                    $card['card_number'],
                    $board
                );
            }
        );

        return $this->twig->render(
            'Scenario/show.html.twig',
            [
                'cards' => $boardCards,
                'scenarioId' => $scenarioId
            ]
        );
    }

    public function draw()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            /*
            Data collection
            */
            $scenarioId = $_POST['scenarioId'];
            $drawCardNumber = $_POST['draw_number'];
            /*
            Scenario Card collection
            */
            $cardManager = new CardManager();
            $cards = $cardManager->selectAllByScenario($scenarioId);
            /*
            Checking presence of the draw card in scenario cards
            */
            $filteredCards = array_filter(
                $cards,
                function ($card) use ($drawCardNumber) {
                    return $card['card_number'] == $drawCardNumber;
                }
            );
            /*
            Checking draw card is not on the board or in the graveyard
            */
            if (
                count($filteredCards) == 1 &&
                !in_array($drawCardNumber, $_SESSION['game']['board']) &&
                !in_array($drawCardNumber, $_SESSION['game']['graveyard'])
            ) {
                $_SESSION['game']['board'][] = $drawCardNumber;
            }
            header('location:/show?id=' . $scenarioId);
        }
    }

    public function discard()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            /*
            Data collection
            */
            $discardCardNumber = $_POST['discardCard'];
            $scenarioId = $_POST['scenarioId'];
            /*
            Checking discard card is on the board and not in the graveyard
            */
            if (
                in_array($discardCardNumber, $_SESSION['game']['board'])
            ) {
                $_SESSION['game']['graveyard'][] = $discardCardNumber;
                /*
                Board's data modification
                */
                $_SESSION['game']['board'] = array_filter(
                    $_SESSION['game']['board'],
                    function ($cardNumber) use ($discardCardNumber) {
                        return $cardNumber != $discardCardNumber;
                    }
                );
            }
            header('location:/show?id=' . $scenarioId);
        }
    }

    public function add()
    {
        $scenarioManager = new ScenarioManager();
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $imageName = basename($_FILES['image_name']['name']);
            if ($_FILES['image_name']['error'] != '0') {
                $imageName = null;
            }
                $uploadFile = realpath("./") . "/assets/images/" . $imageName;
                move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadFile);
                $id = $scenarioManager->save($_POST['name'], $_POST['description'], $_POST['realised_by'], $imageName);
                header('Location:/addcard?id=' . $id);
        }
        $scenarios = $scenarioManager->selectAll();
        return $this->twig->render('Scenario/add.html.twig', ['scenarios' => $scenarios]);
    }

    public function edit()
    {
        $editScenario = new ScenarioManager();
        $scenario = $editScenario->selectOneById($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageName = basename($_FILES['image_name']['name']);
            if ($scenario['image_name'] != $imageName && !empty($scenario['image_name'])) {
                unlink(realpath("./") . "/assets/images/" . $scenario['image_name']);
            }
            if ($_FILES['image_name']['error'] != '0') {
                $imageName = null;
            }
            $uploadFile = realpath("./") . "/assets/images/" . $imageName;
            move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadFile);
            $editScenario->
            update($_GET['id'], $_POST['name'], $_POST['description'], $_POST['realised_by'], $imageName);
            header('Location:/edit');
        }

        return $this->twig->render('Scenario/edit.html.twig', ['scenario' => $scenario]);
    }

    public function delete()
    {
        $deleteCardImage = new CardManager();
        $imageCardName = $deleteCardImage->selectAllByScenario($_GET['id']);
        foreach ($imageCardName as $name) {
            unlink(realpath("./") . "/assets/images/" . $name["image_name"]);
        }
        $deleteScenario = new ScenarioManager();
        $imageScenarioName = $deleteScenario->selectOneById($_GET['id']);
        if ($imageScenarioName['image_name'] != null) {
            unlink(realpath("./") . "/assets/images/" . $imageScenarioName["image_name"]);
        }
        $deleteScenario->delete($_GET['id']);
        header("Location: /");
    }
}
