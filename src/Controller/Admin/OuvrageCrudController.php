<?php

namespace App\Controller\Admin;

use App\Entity\Ouvrage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OuvrageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ouvrage::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('resume'),
            IntegerField::new('prix'),
        ];
    }

}
