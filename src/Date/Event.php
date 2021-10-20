<?php

namespace Date;

class Event
{
    private $id;
    private $name;
    private $description;
    private $start;
    private $end;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description ?? '';
    }

    public function getStart()
    {
        return new \DateTime($this->start);
    }

    public function getEnd()
    {
        return new \DateTime($this->end);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }
}
