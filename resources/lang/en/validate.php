<?php

return [
    // required
    'requiredFullname' => 'Fullname is required.',
    'requiredUsername' => 'Username is required.',
    'requiredPhone' => 'Phone is required.',
    'requiredPassword' => 'Password is required.',
    'requiredEmail' => 'Email is required.',
    // min
    'minFullname' => 'Fullname is too short. It should have 5 characters or more.',
    'minUsername' => 'Username is too short. It should have 3 characters or more.',
    // max
    'maxUsername' => 'Username is too long. It should have 255 characters or fewer.',
    'maxPhone' => 'Phone is too short. It should have 11 characters or more.',
    // unique
    'uniqueEmail' => 'Email already exists.',
    'uniqueUsername' => 'Username already exists.',
    // regex
    'regexPhone' => 'Phone is incorrect.',
    'regexEmail' => 'Email is incorrect.',
    'regexUsername' => 'Username is incorrect. Username only contains the characters A-Z, a-z, 0-9 and underlined oil. Does not contain spaces. Username is 3 -> 32 characters long.',
    'regexPassword' => 'Password is incorrect. The first letter is not a numeric character. Has a length of 3 -> 32 characters. Does not contain spaces.'
];
