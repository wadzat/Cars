<?php

namespace App\Controller\Admin;

use App\Entity\Energy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EnergyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Energy::class;
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
