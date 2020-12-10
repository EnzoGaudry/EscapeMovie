<?php

namespace App\Controller;

use App\Model\CardManager;

class CardController extends AbstractController
{
    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $imageName = basename($_FILES['image_name']['name']);
                $uploadFile = realpath("./") . "/assets/images/" . $imageName;
                move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadFile);
                $addCards = new CardManager();
                $addCards->save($_POST['name'], $_POST['text'], $_POST['card_number'], $_GET['id'], $imageName);
        }
        $showCard = new CardManager();
        $cards = $showCard->selectAllByScenario($_GET['id']);
        $id = $_GET['id'];
        return $this->twig->render('Card/add.html.twig', ['cards' => $cards, 'id' => $id]);
    }

    public function delete(int $id)
    {
        $cardManager = new CardManager();
        $card = $cardManager->selectOneById($id);
        $cardManager->delete($id);
        if (!empty($card["image_name"])) {
            unlink(realpath("./") . "/assets/images/" . $card["image_name"]);
        }
        header('Location:/addcard?id=' . $card["scenario_id"]);
    }


    public function edit()
    {
        $editCard = new CardManager();
        $card = $editCard->selectOneById($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageName = basename($_FILES['image_name']['name']);
            if ($card['image_name'] != $imageName && !empty($card['image_name'])) {
                unlink(realpath("./") . "/assets/images/" . $card['image_name']);
            }
            $uploadFile = realpath("./") . "/assets/images/" . $imageName;
            move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadFile);
            $editCard->update($_GET['id'], $_POST['name'], $_POST['text'], $_POST['card_number'], $imageName);
            header('Location:/addcard?id=' . $card['scenario_id']);
        }

        return $this->twig->render('Card/edit.html.twig', ['card' => $card]);
    }
}
