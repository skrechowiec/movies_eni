<?php

namespace MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminMoviesController extends Controller
{
    public function gestionAction()
    {
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movies = $repo->findUpMovies();
        return $this->render('MoviesBundle:admin:gestion.html.twig',[
        "movies" => $movies
        ]);
    }
}
