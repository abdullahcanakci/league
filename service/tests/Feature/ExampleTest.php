<?php


it('serves', function () {
    /** @var \Tests\TestCase $this */
    $this->get('/')->assertStatus(200);
});
