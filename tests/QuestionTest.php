<?php
/**
 * @author: Michael Kumar <michael.kumar@sirma.bg>
 * Date: 29.11.17
 * Time: 18:04
 */

namespace xXc\Questionary\Tests;
use xXc\Questionary\Question;

use PHPUnit\Framework\TestCase;


/**
 * Class QuestionTest
 * @package xXc\Questionary\Tests
 */
class QuestionTest extends TestCase
{
    /**
     * @var Question
     */
    protected  $question;

    protected function setUp()
    {

        $this->question = new Question();
    }

    public function testQuestionTimeSetter()
    {
        $this->question->setTime(30);
        $this->assertEquals('30', $this->question->getTime());
    }

    public function testAddCondition()
    {
        $this->question->addTextCondition('should we use tests?');
        $this->assertEquals(['text' => 'should we use tests?'], $this->question->getCondition());
    }


}