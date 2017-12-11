<?php
/**
 * @author: Michael Kumar <michael.kumar@sirma.bg>
 * Date: 29.11.17
 * Time: 18:04
 */

namespace xXc\Questionary\Tests;

use Exception;
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
    protected $question;

    protected function setUp()
    {

        $this->question = new Question();
    }

    public function testQuestionTimeSetter()
    {
        $this->question->setTime(30);
        $this->assertEquals('30', $this->question->getTime());
    }

    public function testQuestionTimeSetterInMinutes()
    {
        $this->question->setTime(1, 'm');
        $this->assertEquals('60', $this->question->getTime());
    }

    public function testQuestionTimeSetterException()
    {
        $this->expectException(Exception::class);
        $this->question->setTime(1, 'x');
    }

    public function testAddCondition()
    {
        $this->question->addTextCondition('should we use tests?');
        $this->assertEquals(['text' => 'should we use tests?'], $this->question->getCondition());
    }


    public function testAddTextConditionException()
    {
        $this->expectException(Exception::class);
        $this->question->addTextCondition(['exception testing']);
    }

    public function testAddImageCondition()
    {
        $this->question->addImageCondition('http://text.jpg', 'link');
        $expectedImageObject         = new \stdClass();
        $expectedImageObject->type   = 'link';
        $expectedImageObject->source = 'http://text.jpg';
        $this->assertEquals(
            [
                'image' => $expectedImageObject,
            ],
            $this->question->getCondition()
        );
    }

    public function testAddImageConditionException()
    {
        $this->expectException(Exception::class);
        $this->question->addImageCondition('image', 'xxx');
    }

    public function testAddQuestionAnswer()
    {
        $expectedAnswer = 'valid answer';
        $this->question->addTextAnswer($expectedAnswer, true);
        $this->assertEquals([$expectedAnswer],
            $this->question->getAnswers()
        );
    }

    public function testAddQuestionAnswers()
    {
        $expectedValidAnswer = 'valid answer';
        $expectedInvalidAnswer = 'valid answer';
        $this->question->addTextAnswer($expectedValidAnswer, true);
        $this->question->addTextAnswer($expectedInvalidAnswer, false);
        $this->assertEquals([$expectedValidAnswer, $expectedInvalidAnswer],
            $this->question->getAnswers()
        );
    }

    public function testGetFilteredInvalidAnswers()
    {
        $expectedValidAnswer = 'valid answer';
        $expectedInvalidAnswer = 'valid answer';
        $this->question->addTextAnswer($expectedValidAnswer, true);
        $this->question->addTextAnswer($expectedInvalidAnswer, false);
        $this->assertEquals([$expectedInvalidAnswer],
            $this->question->getAnswers('invalid')
        );
    }

    public function testGetFilteredValidAnswers()
    {
        $expectedValidAnswer = 'valid answer';
        $expectedInvalidAnswer = 'valid answer';
        $this->question->addTextAnswer($expectedValidAnswer, true);
        $this->question->addTextAnswer($expectedInvalidAnswer, false);
        $this->assertEquals([$expectedValidAnswer],
            $this->question->getAnswers('valid')
        );
    }


    public function testGetFilteredValidAnswersException()
    {
        $this->expectException(Exception::class);
        $this->question->getAnswers('xxxx');

    }

}