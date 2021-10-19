<?php

namespace Date;

use PDO;

class Events
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    /**
     * Récupère les évènements entre deux dates
     *
     * @param [type] $start
     * @param [type] $end
     * @return array
     */
    public function getEventsBetween($start, $end)
    {
        $sql = "SELECT * FROM evenements WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Récupère les évènements entre deux dates indéxé par jour
     *
     * @param [type] $start
     * @param [type] $end
     * @return array
     */
    public function getEventsBetweenByDay($start, $end)
    {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date] = $event;
            }
            return $days;
        }
    }

    /**
     * Récupère un évènement
     *
     * @param [type] $id
     * @return Event
     */
    public function find($id)
    {
        require '../src/Date/Event.php';
        $statement = $this->pdo->query("SELECT * FROM evenements WHERE id = $id LIMIT 1");
        $statement->setFetchMode(PDO::FETCH_CLASS, Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }
}