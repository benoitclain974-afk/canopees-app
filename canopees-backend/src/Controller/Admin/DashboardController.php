<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle('Canopees Backend');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

        yield MenuItem::section('Service');
        yield MenuItem::linkTo(PrestationCrudController::class, 'Prestation', 'fas fa-list');
        yield MenuItem::linkTo(OeuvreCrudController::class, 'Oeuvre', 'fas fa-images');
        yield MenuItem::linkTo(TarifCrudController::class, 'Tarif', 'fas fa-euro-sign');

        yield MenuItem::section('Client');
        yield MenuItem::linkTo(ClientCrudController::class, 'Client', 'fas fa-users');
        yield MenuItem::linkTo(DemandeDevisCrudController::class, 'Demande Devis', 'fas fa-envelope');

        yield MenuItem::section('Personnel');
        yield MenuItem::linkTo(OuvrierCrudController::class, 'Ouvrier', 'fas fa-hard-hat');
    }



}