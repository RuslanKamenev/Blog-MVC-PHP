<?php

//Получение данных из словаря
function label ($data, $file = 'common') {
    echo App::$registry->dict[$file][$data];
}

