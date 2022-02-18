<?php

namespace App\Normalizer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Entity denormalizer
 */
class EntityDenormalizer implements DenormalizerInterface
{
    /** @var EntityManagerInterface **/
    protected $em;

    // Récupération de service
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Should this denormalizer be applied to the current data?
     * yes ? we call $this->denormalize()
     * 
     * $data => Genre_id
     * $type => the type of the class to which we want to denormalize $data
     * 
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        // Is the class of type Entity doctrine ?
        // Is the data provided numerical ?
        return strpos($type, 'App\\Entity\\') === 0 && (is_numeric($data));
    }

    /**
     * This method will be called if the condition above is valid
     * 
     * @inheritDoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        // Shortcut from the EntityManager to check an entity
        return $this->em->find($class, $data);
    }
}
