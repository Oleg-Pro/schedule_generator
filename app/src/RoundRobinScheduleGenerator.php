<?php

namespace App;

use App\Entity\Team;
use App\Entity\Tournament;
use App\Entity\TournamentParticipant;
use App\Repository\TeamRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class RoundRobinScheduleGenerator
{
    private const MAX_MATCHES_PER_DAY = 4;


    public function __construct(protected TeamRepository $teamRepository, protected EntityManagerInterface $em)
    {
    }

    public function generateSchedule(Tournament $tournament, DateTime $startDate): array
    {
        $teams = $this->teamRepository->findAll();

        $teamsNumber = count($teams);
        $teamIds = array_map(static function(Team $element) {
            return $element->getId();
        }, $teams);

        if (count($teamIds)%2 !== 0){
            $teamIds[] = null;
        }

        $tournamentParticipants = [];

        $currentDate = clone $startDate;

        $halfTeams = $teamsNumber / 2;
        $matchesNumber = 0;


        $numberOfMatchesForDate = 0;

        for ($i = 0; $i < $teamsNumber - 1; $i++) {
            for ($j = 0; $j < $teamsNumber/2; $j++) {
                $tournamentParticipant = new TournamentParticipant();
                $tournamentParticipant->setTournament($tournament)
                                      ->setTeam1($this->em->getReference(Team::class, $teamIds[$j]))
                                      ->setTeam2($this->em->getReference(Team::class, $teamIds[$j + $halfTeams]))
                                      ->setDate($currentDate);
                $tournamentParticipants[] = $tournamentParticipant;
                $numberOfMatchesForDate++;

                if ($numberOfMatchesForDate === static::MAX_MATCHES_PER_DAY) {
                    $numberOfMatchesForDate = 0;
                    $currentDate = clone $currentDate;

                    $currentDate->modify('+1 day');
                    $numberOfMatchesForDate;
                }
            }

            $currentDate = clone $currentDate;
            $currentDate->modify('+1 day');
            $numberOfMatchesForDate = 0;

            $this->rotateCyclic($teamIds, 1, $teamsNumber - 1);
        }

        return $tournamentParticipants;
    }

    private function rotateCyclic(array &$arr, int $fromIndex, int $toIndex): void
    {
        $last = $arr[$toIndex];
        for ($i = $toIndex; $i > $fromIndex; $i--) {
            $arr[$i] = $arr[$i - 1];
        }

        $arr[$fromIndex] = $last;
    }

}

