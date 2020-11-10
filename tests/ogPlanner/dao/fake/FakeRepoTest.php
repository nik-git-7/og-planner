<?php

namespace ogPlanner\dao\fake;


use ogPlanner\model\Lesson;
use PHPUnit\Framework\TestCase;

class FakeRepoTest extends TestCase
{
    public function testAll()
    {
        $fakeLessonRepo = new FakeLessonRepo([
            new Lesson(1, 2, 3, 5, 'en1'),
            new Lesson(2, 3, 0, 2, 'de3'),
            new Lesson(3, 2, 5, 5, 'en1'),
            new Lesson(4, 1, 5, 6, 'de5'),
            new Lesson(5, 1, 1, 1, 'en1'),
            new Lesson(6, 2, 3, 5, 'en1'),
        ]);

        $timetable2Lessons = $fakeLessonRepo->findByTimetableId(2);
        $lesson3 = $fakeLessonRepo->findById(3);
        $timetable2Day3Lessons = $fakeLessonRepo->findByTimetableIdAndDay(2, 3);
        $notALesson = $fakeLessonRepo->findById(10);

        $expectedLesson3 = new Lesson(3, 2, 5, 5, 'en1');
        $expectedTimetable2Lessons = [
            new Lesson(1, 2, 3, 5, 'en1'),
            new Lesson(3, 2, 5, 5, 'en1'),
            new Lesson(6, 2, 3, 5, 'en1')
        ];
        $expectedTimetable2Day3Lessons = [
            new Lesson(1, 2, 3, 5, 'en1'),
            new Lesson(6, 2, 3, 5, 'en1')
        ];
        $this->assertEquals($expectedTimetable2Lessons, $timetable2Lessons);
        $this->assertEquals($expectedLesson3, $lesson3);
        $this->assertEquals($expectedTimetable2Day3Lessons, $timetable2Day3Lessons);
        $this->assertNull($notALesson);
    }
}
