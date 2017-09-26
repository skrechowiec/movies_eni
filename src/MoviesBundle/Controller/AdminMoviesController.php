<?php

namespace MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoviesBundle\Entity\Movie;
use MoviesBundle\Form\MovieType;
use Symfony\Component\HttpFoundation\Request;


class AdminMoviesController extends Controller
{
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('MoviesBundle:Movie');
        $movie = $repo->find($id);

        $em->remove($movie);
        $this->addFlash("success", "le film ".$movie->getTitle()." a bien été supprimé");
        $em->flush();
        return $this->redirectToRoute("AdminMovies");
    }
    public function editReviewAction($id, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movie = $repo->find($id);

            $form = $this->createForm(MovieType::class, $movie);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($movie);
                $em->flush();

                $this->addFlash("success", "votre film ".$movie->getTitle()." a bien été modifié");
                return $this->redirectToRoute("detailMovies", ["id" => $movie->getId()]);

            }

            return $this->render('MoviesBundle:movies:editl.html.twig', [
                "form" => $form->createView(),
                "movie" => $movie
            ]);

    }
    public function gestionAction()
    {
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Movie');
        $movies = $repo->findUpAllMovies();
        return $this->render('MoviesBundle:admin:gestion.html.twig',[
        "movies" => $movies
        ]);
    }
    public function createAction(Request $request)
    {
        $movie = new Movie();
        $movie->setYear("1990");
        $movie->setDateCreated(new \DateTime('now'));
        $movie->setImdbId(time());
        $movie->setRating("5");
        $movie->setVotes("0");
        $movie->setDateModified(new \DateTime('now'));

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash("success", "votre film a bien été enregistré");
            return $this->redirectToRoute("detailMovies", ["id" => $movie->getId()]);
        }

    return $this->render('MoviesBundle:admin:create.html.twig',[
        "form" => $form->createView()
        ]);
    }
}
