<?php

namespace MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MoviesController extends Controller
{
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
