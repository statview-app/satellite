<?php

describe('Features', function () {
    test('Extends basic features')
        ->expect('Statview\Satellite\Features')
        ->toExtend('Statview\Satellite\Feature');
});
