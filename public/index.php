<?php

use ogPlanner\dao\ILessonRepo;
use ogPlanner\dao\IUserCourseTimetableConnectorRepo;
use ogPlanner\dao\IUserRepo;
use ogPlanner\Main;
use ogPlanner\model\Lesson;
use ogPlanner\model\User;
use ogPlanner\model\UserCourseTimetableConnector;


function main(): array
{
    /** @var IUserRepo $userRepo */
    /** @var IUserCourseTimetableConnectorRepo $connectorRepo */
    /** @var ILessonRepo $lessonRepo */
    $entityManager = Config::getEntityManager();
    $userRepo = $entityManager->getRepository(User::class);
    $connectorRepo = $entityManager->getRepository(UserCourseTimetableConnector::class);
    $lessonRepo = $entityManager->getRepository(Lesson::class);

    $main = new Main(Config::PLANNER_URL, $userRepo, $connectorRepo, $lessonRepo);
    return $main->run();
}

echo json_encode(main());

/*function withLogger(string $msg, $fun): void
{
    $code = $fun();
    Util::logToFile(sprintf($msg, $code));
    echo sprintf($msg, $code);
}*/