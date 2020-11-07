<?php


namespace ogPlanner\controller;

require_once '../../../public/config.php';

use ogPlanner\model\IEntry;
use ogPlanner\model\IUser;

class OGMailer
{
    public static function sendEntryMail(IUser $user, array $entries): bool
    {
        $subject = 'Du hast Vertretung';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $content = '<h2>Hallo ' . $user->getName() . '</h2>';
        $content .= '<p>Du hast Vertretung!</p>';
        $content .= '<table>
                        <thead>
                            <th>Klasse</th>
                            <th>Stunde</th>
                            <th>Vertreter</th>
                            <th>Fach</th>
                            <th>Raum</th>
                            <th>Art</th>
                            <th>Mitteilung</th>
                        </thead>
                        <tbody>';

        /** @var IEntry $entry */
        foreach ($entries as $entry) {
            $content .= "<tr>
                                <td>{$entry->getSchoolClass()}</td>
                                <td>{$entry->getLesson()}</td>
                                <td>{$entry->getRepresentative()}</td>
                                <td>{$entry->getRoom()}</td>
                                <td>{$entry->getKind()}</td>
                                <td>{$entry->getNotification()}</td>
                            </tr>";
        }

        $plannerUrl = PLANNER_URL;
        $content .= '</tbody></table>';
        $content .= "<p>Für die Richtigkeit dieser Angaben übernehmen wir keine Haftung.
                        Bitte prüfe auf <a href='{$plannerUrl}'>{$plannerUrl}</a>,
                        ob deine Stunden wirklich vertreten werden!</p>";

        return mail($user->getEMail(), $subject, $content, $headers);
    }
}
