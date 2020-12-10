<?php

namespace App\Controller;

class PageController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit()
    {
        return $this->twig->render('Scenario/index.html.twig');
    }
}
