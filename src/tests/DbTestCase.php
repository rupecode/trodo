<?php

namespace Tests;

use Illuminate\Support\Facades\DB;

class DbTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollback();
    }
}
