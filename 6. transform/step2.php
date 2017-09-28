<?php

/* This not very easy to read! */
function getUsersEmailsWithInlineTemp($users)
{
    return map(filter($users, function ($user) {
            return $user->email !== null;
        }), function ($user) {
            return $user->email;
        }
    );
}

/**
 * The reason this code is difficult to understand is because
 *      it has to be read inside-out.
 *
 * Since arrays/strings/etc. are primitive types, we have to operate
 * with them from the outside by passing them as parameters into other functions.
 *
 * This is what leads to inside-out code, where you need to count the braces,
 * to figure out what's happening first.
 */

/** Example of inside-out with strings */
$camelString = lcfirst(
    str_replace(' ', '',
        ucwords(str_replace('_', ' ', $snakeString))
    )
);
/** Example of a better version with the same strings */
$camelString = $snakeString->replace('_', ' ')
                            ->ucwords()
                            ->replace(' ', '')
                            ->lcfirst();

/**
 * Much easier to understand, right?
 *
 * The difference is we're treating $snakeString as an object instead of a primitive,
 * by calling methods on the object directly instead of passing it around as a parameter.
 */

/**
 * Getting back to our function, let's transform our arrays into objects.
 */
function getUsersEmailsWithObjects($users)
{
    return $users->filter(function ($user) {
        return $user->email !== null;
    })->map(function ($user) {
        return $user->email;
    });
}

/* And we get a collection pipeline. */

/* Let's implement a Collection class that encapsulates an array. */
class Collection
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public static function make($items)
    {
        return new static($items);
    }

    public function map($callback)
    {
        return new static(array_map($callback, $this->items));
    }

    public function filter($callback)
    {
        return new static(array_filter($this->items, $callback));
    }

    public function toArray()
    {
        return $this->items;
    }
}

// Our function becomes,
function getUsersEmailsWithCollection($users)
{
    return (new Collection($users))->filter(function ($user) {
        return $user->email !== null;
    })->map(function ($user) {
        return $user->email;
    });
}

/**
 * Chaining methods after a traditional constructor can look a bit cluttered,
 * so I'll often create a named constructor to clean things up:
 */
function getUsersEmailsWithCollectionMake($users)
{
    return Collection::make($users)->filter(function ($user) {
        return $user->email !== null;
    })->map(function ($user) {
        return $user->email;
    });
}