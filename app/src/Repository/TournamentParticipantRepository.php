<?php

namespace App\Repository;

use App\Entity\Tournament;
use App\Entity\TournamentParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TournamentParticipant>
 *
 * @method TournamentParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method TournamentParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method TournamentParticipant[]    findAll()
 * @method TournamentParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TournamentParticipant::class);
    }

    public function getTournamentMatchesByTournament(Tournament $tournament): array
    {
        $matchesByDates = [];

//        var_dump($this->createQueryBuilder('tp')
//            ->select('tp', 't', 'team1', 'team2')
//            ->join('tp.tournament', 't')
//            ->join('tp.team1', 'team1')
//            ->join('tp.team2', 'team2')
//            ->where('tp.tournament = :tournament')
//            ->setParameter('tournament', $tournament)
//            ->orderBy('tp.date')
//            ->getQuery()->getSQL());


        $tournamentParticipants = $this->createQueryBuilder('tp')
            ->select('tp', 't', 'team1', 'team2')
            ->join('tp.tournament', 't')
            ->join('tp.team1', 'team1')
            ->join('tp.team2', 'team2')
            ->where('tp.tournament = :tournament')
            ->setParameter('tournament', $tournament)
            ->orderBy('tp.date')
            ->getQuery()->getResult();

//        $tournamentParticipants = $this->createQueryBuilder('tp')
//            ->select('tp', 't', 't1', 't2')
//            ->join('tp.tournament', 't')
//            ->join('tp.team1', 't1')
//            ->join('tp.team2', 't2')
//            ->where('tp.tournament = 15')
//            ->orderBy('tp.date')
//            ->getQuery()->getResult();
//

        var_dump(count($tournamentParticipants));
        exit;

//        $number = count($tournamentParticipants);
//        if ($number === 0) {
//            throw new \Exception(count($tournamentParticipants));
//        }
//
//

        /** @var TournamentParticipant $tournamentParticipant */
        foreach ($tournamentParticipants as $tournamentParticipant) {
            $date = $tournamentParticipant->getDate()->format('d.m.Y');
            if (!array_key_exists($date, $matchesByDates)) {
                $matchesByDates[$date] = [];
            }

            $matchesByDates[$date][] = [
                'team1' => $tournamentParticipant->getTeam1()->getName(),
                'team2' => $tournamentParticipant->getTeam2()->getName(),
            ];
        }

        return $matchesByDates;
    }


    public function getTournamentMatchesByDates(string $tournamentName): array
    {
        $matchesByDates = [];

//        var_dump($this->createQueryBuilder('tp')
//            ->select('tp', 't', 'team1', 'team2')
//            ->join('tp.tournament', 't')
//            ->join('tp.team1', 'team1')
//            ->join('tp.team2', 'team2')
//            ->where('t.name = :name')
//            ->setParameter('name', $tournamentName)
//            ->orderBy('tp.date')
//            ->getQuery()->getSQL());
//        var_dump($tournamentName);
//        exit;
//

        $tournamentParticipants = $this->createQueryBuilder('tp')
//            ->select('tp', 't', 't1', 't2')
            ->join('tp.tournament', 't')
//            ->join('tp.team1', 't1')
//            ->join('tp.team2', 't2')
            ->where('t.name = :name')
            ->setParameter('name', $tournamentName)
            ->orderBy('tp.date')
            ->getQuery()->getResult();

//        $tournamentParticipants = $this->createQueryBuilder('tp')
//            ->select('tp', 't', 't1', 't2')
//            ->join('tp.tournament', 't')
//            ->join('tp.team1', 't1')
//            ->join('tp.team2', 't2')
//            ->where('tp.tournament = 15')
//            ->orderBy('tp.date')
//            ->getQuery()->getResult();
//

//        var_dump(count($tournamentParticipants));
//        exit;

//        $number = count($tournamentParticipants);
//        if ($number === 0) {
//            throw new \Exception(count($tournamentParticipants));
//        }
//
//

        /** @var TournamentParticipant $tournamentParticipant */
        foreach ($tournamentParticipants as $tournamentParticipant) {
            $date = $tournamentParticipant->getDate()->format('d.m.Y');
            if (!array_key_exists($date, $matchesByDates)) {
                $matchesByDates[$date] = [];
            }

            $matchesByDates[$date][] = [
                'team1' => $tournamentParticipant->getTeam1()->getName(),
                'team2' => $tournamentParticipant->getTeam2()->getName(),
            ];
        }



        return $matchesByDates;
    }

//    /**
//     * @return TournamentParticipant[] Returns an array of TournamentParticipant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TournamentParticipant
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
