<?php

namespace App\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class DtoValueResolver implements ValueResolverInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $type = $argument->getType();
        
        // Vérifier si le type se termine par "Dto" (nos classes DTO)
        if (!$type || !str_ends_with($type, 'Dto')) {
            return [];
        }

        try {
            // Récupérer le contenu JSON
            $content = $request->getContent();
            // echo "JSON reçu: " . $content . "\n";
            // echo "Type attendu: " . $type . "\n";
            
            // Désérialiser en objet DTO
            $dto = $this->serializer->deserialize(
                $content,
                $type,
                'json',
                [
                    'allow_extra_attributes' => false,  // Rejette les propriétés inconnues
                    'disable_type_enforcement' => false,
                ]
            );

            return [$dto];
        } catch (NotEncodableValueException $e) {
            // Si le JSON n'est pas valide, retourner une erreur
            echo "Erreur NotEncodableValueException: " . $e->getMessage() . "\n";
            return [];
        } catch (\Exception $e) {
            // Gérer les autres erreurs
            echo "Erreur Exception: " . $e->getMessage() . "\n";
            echo "Classe: " . get_class($e) . "\n";
            return [];
        }
    }
}
