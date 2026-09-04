<?php

test('the home page displays', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('tambours chamaniques', false);
});
