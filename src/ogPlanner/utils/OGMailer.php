<?php


namespace ogPlanner\utils;

require_once BASEDIR . 'src/ogPlanner/model/IEntry.php';
require_once BASEDIR . 'src/ogPlanner/model/IUser.php';

use ogPlanner\model\IEntry;
use ogPlanner\model\IUser;

class OGMailer
{
    public static function sendEntryMail(IUser $user, array $entries, $planDate): bool
    {
        $subject = 'Du hast Vertretung';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $content = "<style>
                        table {
                          border-collapse: collapse;
                          width: 100%;
                        }
                        
                        td, th {
                          border: 1px solid #dddddd;
                          text-align: left;
                          padding: 8px;
                        }
                        
                        tr:nth-child(even) {
                          background-color: #dddddd;
                        }
                    </style>";
        $content .= "<h2>Hallo {$user->getName()}</h2>";
        $content .= "<p>Du hast am <b>{$planDate}</b> Vertretung!</p>";
        $content .= '<table>
                        <tr>
                            <th>Klasse</th>
                            <th>Pos</th>
                            <th>Vertreter</th>
                            <th>Fach</th>
                            <th>Raum</th>
                            <th>Art</th>
                            <th>Mitteilung</th>
                        </tr>';

        /** @var IEntry $entry */
        foreach ($entries as $entry) {
            $content .= "<tr>
                                <td>{$entry->getSchoolClass()}</td>
                                <td>{$entry->getLesson()}</td>
                                <td>{$entry->getRepresentative()}</td>
                                <td>{$entry->getSubject()}</td>
                                <td>{$entry->getRoom()}</td>
                                <td>{$entry->getKind()}</td>
                                <td>{$entry->getNotification()}</td>
                            </tr>";
        }

        $plannerUrl = PLANNER_URL;
        $content .= '</table>';
        $content .= "<p>Für die Richtigkeit dieser Angaben übernehmen wir keine Haftung.
                        Bitte prüfe auf <a href='{$plannerUrl}'>{$plannerUrl}</a>,
                        ob deine Stunden wirklich vertreten werden!
                        <br />
                        <br />
                        <br />
                        Viele Grüße<br />
                        Dein OG-Planner-Team
                        <br />
                        <br />
                        <br />
                        Dies ist eine automatisch generierte Mail. Bitte antworte nicht darauf.
                        Bei Fragen oder Anregungen kannst du dich gerne drirekt an uns wenden!
                    </p>";

        return mail($user->getEmail(), $subject, $content, $headers);
    }
}
