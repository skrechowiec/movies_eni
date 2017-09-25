<?php

namespace MoviesBundle\Controller;

use MoviesBundle\Entity\Review;
use MoviesBundle\Form\MovieType;
use MoviesBundle\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends Controller
{
    public function detailAction($id, Request $request)
    {
        //le repository sert à faire des SELECT dans cette table
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movie = $repo->find($id);

        $review = new Review();
        $review->setFilm($movie);

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            $this->addFlash("success", "votre critique a été prise en compte");
            return $this->redirectToRoute("detailMovies", ["id" => $movie->getId()]);

        }

        return $this->render('MoviesBundle:movies:detail.html.twig', [
            "form" => $form->createView(),
            "movie" => $movie
        ]);
    }public function indexAction()
    {
        //le repository sert à faire des SELECT dans cette table
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movies = $repo->findUpMovies();
        return $this->render('MoviesBundle:Default:index.html.twig', [
            "movies" => $movies
        ]);
    }
}


