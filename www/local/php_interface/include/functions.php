<?php

function dump($var, $die = false, $all = false)
{
    global $USER;
    if ($USER->IsAdmin() || ($all == true)) {
        ?>
        <pre><?var_dump($var)?></pre><br>
        <?php
    }
    if ($die) {
        die;
    }
}

function getUserId()
{
    global $USER;
    return $USER->GetID();
}


