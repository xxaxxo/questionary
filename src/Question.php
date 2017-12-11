<?php

namespace xXc\Questionary;


class Question
{
    private $time = false;
    private $condition = array();

    public function setTime($duration, $units = 's')
    {
        switch ($units)
        {
            case 's':
                $secondDuration = (int)$duration;
                break;
            case 'm':
                $secondDuration = (int)$duration * 60;
                break;
            case 'h':
                $secondDuration = (int)$duration * 60 * 60;
                break;
            default:
                throw new \Exception('The provided unit for period is not defined - choose between s / m / h');
                break;
        }
        $this->time = (int)$secondDuration;
    }

    public function addTextCondition($text)
    {
        if(!is_string($text))
        {
            throw new \Exception('The text condition should be a string');
        }

        $this->condition['text'] = $text;
    }

    public function addImageCondition($source, $type = 'link')
    {
        $permittedTypes = [
            'link', 'file'
        ];
        if(!in_array($type, $permittedTypes))
            throw new \Exception('Not permitted type passed - permitted types: '.implode(',',$permittedTypes));

        $image = new \stdClass();
        $image->type = $type;
        $image->source = $source;
        $this->condition['image'] = $image;
    }


    public function getTime()
    {
        return $this->time;
    }

    public function getCondition()
    {
        return $this->condition;
    }




}
