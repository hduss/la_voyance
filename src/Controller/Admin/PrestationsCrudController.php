<?php

namespace App\Controller\Admin;

use App\Entity\Prestations;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PrestationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestations::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name', 'Nom de la prestation'),
            yield TextField::new('description', 'Description courte'),
            yield TextareaField::new('long_description', 'Description longue'),
        ];
    }

}
