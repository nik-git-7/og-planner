<?php


class Config
{
    const 'EXIT_SUCCESS' =  0;
    const 'EXIT_FAILURE' =  1;
    
    const 'DB_HOST' =  '127.0.0.1';
    const 'DB_USERNAME' =  'root';
    const 'DB_PASSWORD' =  '';
    const 'DB_NAME' =  'og-db';
    const 'DB_DRIVER' =  'pdo_mysql';
    const 'BASEDIR' =  __DIR__ . '/../';
    
    const 'PLANNER_URL' =  'http://vertretungsplan.gym-oppenheim.de/V_DC_001.html';
    //const 'PLANNER_URL' =  BASEDIR . 'tests/res/planner_page_1.html'
    
    const 'LOG_FILE' =  '../var/logfile.log';
    const 'LAST_UPDATE' =  '../var/last_update';
}