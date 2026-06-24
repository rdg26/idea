<?php

declare(strict_types=1);

it('creates a new idea', function () {
    visit('/ideas')
        ->click('@create-idea-button')
        ->debug();
});
