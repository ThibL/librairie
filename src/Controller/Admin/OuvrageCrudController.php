<?php

namespace App\Controller\Admin;

use App\Entity\Ouvrage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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
           yield TextField::new('titre')
                ->setFormTypeOptions([
                    'by_reference' => false
                ]),
            yield TextField::new('ISBN')
                ->setFormTypeOptions([
                    'by_reference' => false
                ]),
            yield TextField::new('theme')
                ->setFormTypeOptions([
                    'by_reference' => false
                ]),
            yield TextEditorField::new('resume')
                ->setFormTypeOptions([
                    'by_reference' => false
                ]),
            yield IntegerField::new('prix')
                ->setFormTypeOptions([
                    'by_reference' => false
                ]),
            yield TextField::new('image')
                ->setFormTypeOptions([
                    'by_reference' => false
                ]),
           yield AssociationField::new('author'),
            yield AssociationField::new('categories')
            ->setFormTypeOptions([
                'by_reference' => false
            ])
        ];
    }

}
