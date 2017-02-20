<?php

$quotes = [
    ["Coming back to where you started is not the same as never leaving.", "Terry Pratchett"],
    ["It is well known that a vital ingredient of success is not knowing that what you're attempting can't be done.", "Terry Pratchett"],
    ["It’s still magic even if you know how it’s done.", "Terry Pratchett"],
    ["So much universe, and so little time.", "Terry Pratchett"],
    ["I love deadlines. I like the whooshing sound they make as they fly by.", "Douglas Adams"],
    ["Flying is learning how to throw yourself at the ground and miss.", "Douglas Adams"]
];

$randomNum = rand(0,5);

$quote = $quotes[$randomNum][0];
$source = $quotes[$randomNum][1];
