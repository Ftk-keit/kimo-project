<?php

namespace App\Config;

use App\Entity\Media;
use App\Entity\Property;
use App\Entity\User;
use App\Entity\Visit;
use App\Entity\Transaction;
use App\Enums\TypeProperty;
use App\Enums\StatusProperty;
use App\Enums\TypeAccount;
use App\Enums\StatusVisit;
use App\Enums\StatusTransaction;
use App\Enums\TypeTransaction;
use App\Repository\MediaRepository;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use App\Repository\VisitRepository;
use App\Repository\TransactionRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DataInitializer
{
    public function __construct(
        private UserRepository $userRepository,
        private PropertyRepository $propertyRepository,
        private TransactionRepository $transactionRepository,
        private VisitRepository $visitRepository,
        private MediaRepository $mediaRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function initialize(): void
    {
        // Créer 2 utilisateurs
        $this->initializeUsers();
        
        // Créer 2 propriétés
        $this->initializeProperties();
        
        // Créer 2 transactions
        $this->initializeTransactions();
        
        // Créer 2 visites
        $this->initializeVisits();
    }

    private function initializeUsers(): void
    {
        // Vérifier s'il y a déjà des utilisateurs
        $existingUsers = $this->userRepository->findAll();
        if (count($existingUsers) >= 2) {
            return;
        }

        // Utilisateur 1 - Vendeur
        $user1 = new User();
        $user1->setEmail('jean.dupont@example.com');
        $user1->setName('Dupont');
        $user1->setFirstname('Jean');
        $user1->setPhone('06123456');
        $user1->setAddress('123 Rue de la Paix, Paris');
        $user1->setRoles([TypeAccount::OWNER->value]);
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'password123'));
        $this->userRepository->save($user1);

        // Utilisateur 2 - Acheteur
        $user2 = new User();
        $user2->setEmail('marie.martin@example.com');
        $user2->setName('Martin');
        $user2->setFirstname('Marie');
        $user2->setPhone('06876543');
        $user2->setAddress('456 Avenue du Monde, Lyon');
        $user2->setRoles([TypeAccount::CLIENT->value]);
        $user2->setPassword($this->passwordHasher->hashPassword($user2, 'password456'));
        $this->userRepository->save($user2);
    }

    private function initializeProperties(): void
    {
        // Vérifier s'il y a déjà des propriétés
        $existingProperties = $this->propertyRepository->findAll();
        if (count($existingProperties) >= 2) {
            return;
        }

        $user = $this->userRepository->findByEmail('jean.dupont@example.com');
        if (!$user) {
            return;
        }

        // Propriété 1 - Maison
        $property1 = new Property();
        $property1->setTitle('Belle maison à Paris');
        $property1->setType(TypeProperty::Maison);
        $property1->setViews(150);
        $property1->setDescription('Une belle maison avec jardin, 4 chambres et 2 salles de bain');
        $property1->setLocation('Paris 15e');
        $property1->setPrice('500000');
        $property1->setSurface('200');
        $property1->setCity('Paris');
        $property1->setBedroom(4);
        $property1->setBathroom(2);
        $property1->setStatus(StatusProperty::PUBLIE);
        $property1->setTypeTransaction(TypeTransaction::VENTE);
        $property1->setCharacteristic(characteristic: ['Balcon', 'Ascenseur', 'Parking']);
        $property1->setOwner($user);
        $this->propertyRepository->save($property1);

        // Ajouter média pour propriété 1
        $media1 = new Media();
        $media1->setUrl('/images/house-paris.jpg');
        $property1->addMedia($media1);

        // Propriété 2 - Appartement
        $property2 = new Property();
        $property2->setTitle('Appartement moderne à Lyon');
        $property2->setType(TypeProperty::Appartement);
        $property2->setViews(85);
        $property2->setDescription('Appartement T3 récemment rénové avec vue sur la ville');
        $property2->setLocation('Lyon Presqu\'île');
        $property2->setPrice('350000');
        $property2->setSurface('120');
        $property2->setCity('Lyon');
        $property2->setBedroom(3);
        $property2->setBathroom(1);
        $property2->setStatus(StatusProperty::PUBLIE);
        $property2->setTypeTransaction(TypeTransaction::VENTE);
        $property2->setOwner($user);
        $property2->setCharacteristic(characteristic: ['Balcon', 'Ascenseur', 'Parking']);
        $this->propertyRepository->save($property2);

        // Ajouter média pour propriété 2
        $media2 = new Media();
        $media2->setUrl('/images/apartment-lyon.jpg');
        $property2->addMedia($media2);
    }

    private function initializeTransactions(): void
    {
        // Vérifier s'il y a déjà des transactions
        $existingTransactions = $this->transactionRepository->findAll();
        if (count($existingTransactions) >= 2) {
            return;
        }

        $seller = $this->userRepository->findByEmail('jean.dupont@example.com');
        $buyer = $this->userRepository->findByEmail('marie.martin@example.com');
        $properties = $this->propertyRepository->findAll();

        if (!$seller || !$buyer || count($properties) < 2) {
            return;
        }

        // Transaction 1
        $transaction1 = new Transaction();
        $transaction1->setSeller($seller);
        $transaction1->setBuyer($buyer);
        $transaction1->setProperty($properties[0]);
        $transaction1->setPrice(5555.00);
        $transaction1->setCommission('25000');
        $transaction1->setDate(new \DateTime('2025-12-10'));
        $transaction1->setStatus(StatusTransaction::COMPLET);
        $transaction1->setAmount(10000);
        $this->transactionRepository->save($transaction1);

        // Transaction 2
        $transaction2 = new Transaction();
        $transaction2->setSeller($seller);
        $transaction2->setBuyer($buyer);
        $transaction2->setProperty($properties[1]);
        $transaction2->setPrice(35000.00);
        $transaction2->setCommission('17500');
        $transaction2->setDate(new \DateTime('2025-12-15'));
        $transaction2->setStatus(StatusTransaction::EN_COURS);
        $transaction2->setAmount(7000);
        $this->transactionRepository->save($transaction2);
    }

    private function initializeVisits(): void
    {
        // Vérifier s'il y a déjà des visites
        $existingVisits = $this->visitRepository->findAll();
        if (count($existingVisits) >= 2) {
            return;
        }

        $client = $this->userRepository->findByEmail('marie.martin@example.com');
        $properties = $this->propertyRepository->findAll();

        if (!$client || count($properties) < 2) {
            return;
        }

        // Visite 1
        $visit1 = new Visit();
        $visit1->setClient($client);
        $visit1->setProperty($properties[0]);
        $visit1->setDate(new \DateTime('2025-12-20'));
        $visit1->setHourse(new \DateTime('10:00:00'));
        $visit1->setStatus(StatusVisit::EN_ATTENTE);
        $this->visitRepository->save($visit1);

        // Visite 2
        $visit2 = new Visit();
        $visit2->setClient($client);
        $visit2->setProperty($properties[1]);
        $visit2->setDate(new \DateTime('2025-12-22'));
        $visit2->setHourse(new \DateTime('14:00:00'));
        $visit2->setStatus(StatusVisit::CONFIRME);
        $this->visitRepository->save($visit2);
    }
}
