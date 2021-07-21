<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Ouvrage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Librairie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Livres', 'fas fa-book', Ouvrage::class);
         yield MenuItem::linkToCrud('Auteurs', 'fas fa-user-alt', Author::class);
         yield MenuItem::linkToCrud('Catégories', 'fas fa-user-alt', Category::class);
    }
}
