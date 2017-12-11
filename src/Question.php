<?php

namespace xXc\Questionary;


class Question
{
    private $time = false;
    private $condition = array();

    public function setTime($duration)
    {
        $this->time = (int)$duration;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function addTextCondition($text)
    {
        if(!is_string($text))
        {
            throw new \Exception('The text condition should be a string');
        }

        $this->condition['text'] = $text;
    }

    public function getCondition()
    {
        return $this->condition;
    }


}
