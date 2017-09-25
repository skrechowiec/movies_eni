<?php

namespace MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        //le repository sert à faire des SELECT dans cette table
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movies = $repo->findUpMovies();
        return $this->render('MoviesBundle:Default:index.html.twig', [
            "movies" => $movies
        ]);
    }
    public function detailAction($id)
    {
        //le repository sert à faire des SELECT dans cette table
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movies = $repo->find($id);
        return $this->render('MoviesBundle:movies:detail.html.twig', [
            "movies" => $movies
        ]);
    }
}
