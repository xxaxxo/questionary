<?php

namespace xXc\Questionary;


class Question
{
    private $time = false;
    private $condition = array();
    private $validAnswers = array();
    private $invalidAnswers = array();
    private $answers = array();

    const TIME_SECONDS = 's';
    const TIME_MINUTES = 'm';
    const TIME_HOURS = 'h';
    const IMAGE_TYPE_LINK = 'link';
    const IMAGE_TYPE_FILE = 'file';
    const VALID = 'valid';
    const INVALID = 'invalid';

    public function setTime($duration, $units = self::TIME_SECONDS)
    {
        $secondDuration = $this->getSecondsDuration($duration, $units);
        $this->time     = (int)$secondDuration;
    }

    public function addTextCondition($text)
    {
        if (!is_string($text)) {
            throw new \Exception('The text condition should be a string');
        }

        $this->condition['text'] = $text;
    }

    public function addImageCondition($source, $type = self::IMAGE_TYPE_LINK)
    {
        $permittedTypes = [
            self::IMAGE_TYPE_LINK,
            self::IMAGE_TYPE_FILE,
        ];
        if (!in_array($type, $permittedTypes)) {
            throw new \Exception('Not permitted type passed - permitted types: '.implode(',', $permittedTypes));
        }

        $image                    = new \stdClass();
        $image->type              = $type;
        $image->source            = $source;
        $this->condition['image'] = $image;
    }

    public function addTextAnswer($answer, $valid)
    {
        $this->answers[] = $answer;
        if ($valid == true) {
            $this->validAnswers[] = $answer;
        } else {
            $this->invalidAnswers[] = $answer;
        }
    }

    public function getAnswers($filter = null)
    {
        if (is_null($filter)) {
            return $this->answers;
        }

        if ($filter == self::VALID) {
            return $this->validAnswers;
        }

        if ($filter == self::INVALID) {
            return $this->invalidAnswers;
        }

        throw new \Exception('Filter for getAnswer accepts only \''.self::VALID.'\' or \''.self::INVALID.'\' params');
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param $duration
     * @param $units
     * @return int
     * @throws \Exception
     */
    private function getSecondsDuration($duration, $units): int
    {
        switch ($units) {
            case self::TIME_SECONDS:
                $secondDuration = (int)$duration;
                break;
            case self::TIME_MINUTES:
                $secondDuration = (int)$duration * 60;
                break;
            case self::TIME_HOURS:
                $secondDuration = (int)$duration * 60 * 60;
                break;
            default:
                throw new \Exception('The provided unit for period is not defined - choose between s / m / h');
                break;
        }

        return $secondDuration;
    }


}
