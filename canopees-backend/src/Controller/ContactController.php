<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\DemandeDevis;
use App\Entity\Prestation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/api/contact', name: 'api_contact', methods: ['POST'])]
    public function contact(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['message' => 'Données invalides'], 400);
        }

        $client = $entityManager->getRepository(Client::class)->findOneBy(['email' => $data['email']]);
        if (!$client) {
            $client = new Client();
            $client->setNom($data['nom']);
            $client->setPrenom($data['prenom'] ?? 'Non renseigné');
            $client->setEmail($data['email']);
            $client->setTelephone($data['telephone']);
            $entityManager->persist($client);
        }

        $prestation = $entityManager->getRepository(Prestation::class)->findOneBy([]) ?? new Prestation();
        if (!$prestation->getId()) {
            $prestation->setTitre('Prestation par défaut');
            $prestation->setContenuDetaille('À définir');
            $entityManager->persist($prestation);
        }

        $devis = new DemandeDevis();
        $devis->setClient($client);
        $devis->setPrestation($prestation);
        $devis->setNom($data['nom'] . ' ' . ($data['prenom'] ?? ''));
        $devis->setEmail($data['email']);
        $devis->setTelephone($data['telephone']);
        $devis->setBudget($data['budget'] ?? null);
        $devis->setAdresse($data['adresse'] ?? null);
        $devis->setMessage($data['message']);

        $entityManager->persist($devis);
        $entityManager->flush();

        return $this->json(['message' => 'Devis bien enregistré !']);
    }
}