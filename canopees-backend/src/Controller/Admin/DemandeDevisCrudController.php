<?php

namespace App\Controller\Admin;

use App\Entity\DemandeDevis;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class DemandeDevisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DemandeDevis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            AssociationField::new('client'),
            AssociationField::new('prestation'),
            AssociationField::new('ouvrier')->setRequired(false),

            TextField::new('nom'),
            EmailField::new('email'),
            TelephoneField::new('telephone'),

            TextField::new('budget')->setRequired(false),
            TextField::new('adresse')->setRequired(false),

            TextEditorField::new('message'),
        ];
    }
}