<?php

// Initial imperative implementation.
function getUserEmails($users)
{
    $emails = [];

    for ($i = 0; $i < count($users); $i++) {
        $user = $users[$i];

        if ($user->email !== null) {
            $emails[] = $user->email;
        }
    }

    return $emails;
}

/**
 * Let's try to make it look like this:
 *
 * SELECT email FROM users WHERE email IS NOT NULL
 */

// Towards declarative implementation: Get rid of foreach.
function getUserEmailsWithForeach($users)
{
    $emails = [];

    foreach ($users as $user) {
        if ($user->email !== null) { // This looks like we can use filter()
            $emails[] = $user->email; // This looks like we can use map()
        }
    }

    // But we can't use one of them to get the result we expect!
    return $emails;
}

/**
 * The problem we're facing right now is that
 *      We're trying to do too many things at the same time!
 *
 * When this happens, try to turn
 *      "I can't because..."
 *          into
 *      "I could if..."
 *
 * Example:
 *      "I can't use map because it would be applied to every user,
 *      not just the users with emails."
 *          into
 *      "I could use map if I was working only with users that have emails."
 */
function getUsersEmailsWithFilterAndMap($users)
{
    $usersWithEmails = filter($users, function ($user) {
        return $user->email !== null;
    });

    $emails = map($usersWithEmails, function ($user) {
        return $user->email;
    });

    return $emails;
}

/**
 * Let's eliminate the temporary variables using
 * Inline Temp(https://refactoring.com/catalog/inlineTemp.html).
 */
function getUsersEmailsWithInlineTemp($users)
{
    return map(filter($users, function ($user) {
            return $user->email !== null;
        }), function ($user) {
            return $user->email;
        }
    );
}

/* That's not very easy to read! */