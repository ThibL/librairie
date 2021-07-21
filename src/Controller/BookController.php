<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Ouvrage;
use App\Form\CommentFormType;
use App\Repository\OuvrageRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function showBook(Ouvrage $book, Request $request, EntityManagerInterface $entityManager) {

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $author=$this->getUser();
            $comment->setAuthor($author);
            $comment->setBook($book);
            $comment->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('show_book',[
                'id'=>$book->getId()
            ]);
        }
        return $this->render('book/show.html.twig', [
            'book' => $book,
            'form'=> $form->createView()
        ]);
    }
}
