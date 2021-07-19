<?php

namespace App\Controller\Admin;

use App\Entity\Ouvrage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OuvrageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ouvrage::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
