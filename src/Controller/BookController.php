<?php

namespace App\Controller;

use App\Entity\Ouvrage;
use App\Repository\OuvrageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="book")
     */
    public function index(OuvrageRepository $repo, Request $request): Response
    {
        $books = $repo->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/book/{id}", name="show_book")
     * @param Ouvrage $book
     * @return Response
     */
    public function showBook(Ouvrage $book) {
        return $this->render('book/show.html.twig', [
            'book' => $book
        ]);
    }
}
