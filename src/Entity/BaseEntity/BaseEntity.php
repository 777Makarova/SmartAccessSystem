<?php

namespace App\Entity\BaseEntity;

use Doctrine\ORM\Mapping as ORM;

class BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $dateCreate;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $dateUpdate;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


}