<?php

namespace App\Entity;

use App\Repository\TournamentParticipantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use DateTime;

#[ORM\Entity(repositoryClass: TournamentParticipantRepository::class)]
class TournamentParticipant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "tournament_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Tournament $tournament = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name:"team1_id", referencedColumnName:"id", nullable: false,  onDelete:"CASCADE")]
    private ?Team $team1 = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name:"team2_id", referencedColumnName:"id", nullable: false, onDelete:"CASCADE")]
    private ?team $team2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
    }

    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    public function setTeam1(?Team $team1): static
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?team
    {
        return $this->team2;
    }

    public function setTeam2(?team $team2): static
    {
        $this->team2 = $team2;

        return $this;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }
}
