<?php

namespace App\Controller\Admin;

use App\Entity\Prestations;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class PrestationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestations::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimeFormat('HH:mm')
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name', 'Nom de la prestation'),
            yield TextField::new('description', 'Description courte'),
            yield TextareaField::new('long_description', 'Description longue'),
            yield TimeField::new('during_time', 'Temps de la consultation')->renderAsChoice(),
        ];
    }

    public function createEntity(string $entityFqcn): Prestations
    {

        $dateTime = new \DateTime('now');
        $time = $dateTime->setTime(0, 30);
        $entity = new Prestations();
        $entity->setDuringTime($time);
        return $entity;
    }

}
