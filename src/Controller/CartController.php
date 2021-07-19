<?php

namespace App\Controller;

use App\Repository\OuvrageRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService): Response
    {
        $panierWithData = $cartService->getFullCart();
        $total = $cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    public function navbarTotal(CartService $cartService) {
        $total = $cartService->getTotal();
        return $this->render('cart/navcart.html.twig', [
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="carte_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @param $id
     * @param SessionInterface $session
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
        return $this->redirectToRoute('cart_index');
    }
}
