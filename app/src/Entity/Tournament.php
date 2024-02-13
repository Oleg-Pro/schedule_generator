<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'tournament')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TournamentParticipant $tournament = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTournament(): ?TournamentParticipant
    {
        return $this->tournament;
    }

    public function setTournament(?TournamentParticipant $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
    }
}
