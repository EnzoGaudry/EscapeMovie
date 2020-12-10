<?php

/**
 * This file dispatch routes.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

use App\Controller\HomeController;
use App\Controller\PageController;
use App\Controller\ScenarioController;
use App\Controller\CardController;

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $urlPath) {
    /*
     * home page
     */
    echo (new HomeController())->index();
} elseif ('/edit' === $urlPath) {
    /*
     * Add Scénario page
     */
    echo (new ScenarioController())->add();
} elseif ('/editscenario' === $urlPath) {
    /*
     * Party choise page
     */
    echo (new ScenarioController())->edit();
} elseif ('/editcard' === $urlPath) {
    echo (new CardController())->edit();
} elseif ('/play' === $urlPath) {
    /*
     * Party choise page
     */
    echo (new ScenarioController())->browse();
} elseif ('/show' === $urlPath) {
    /*
     * Boardgame page
     */
    echo (new ScenarioController())->show($_GET['id']);
} elseif ('/draw' === $urlPath) {
    /*
     * draw page
     */
    echo (new ScenarioController())->draw();
} elseif ('/discard' === $urlPath) {
    /*
     * discard page
     */
    echo (new ScenarioController())->discard();
} elseif ('/addcard' === $urlPath) {
    /*
     * add card page
     */
    echo (new CardController())->add();
} elseif ('/delete' === $urlPath) {
    echo (new CardController())->delete($_GET['id']);
} elseif ('/cancel' === $urlPath) {
    echo (new ScenarioController())->delete();
} else {
    header('HTTP/1.1 404 Not Found');
}
