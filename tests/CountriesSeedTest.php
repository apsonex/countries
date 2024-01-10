<?php

namespace Apsonex\Countries\Tests;

use Apsonex\Countries\Actions\SeedCountryAction;
use Apsonex\Countries\Models\Country;
use Apsonex\Countries\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountriesSeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_seed_countries()
    {
        $this->assertDatabaseCount(Country::class, 0);
        $this->assertDatabaseCount(Province::class, 0);

        SeedCountryAction::execute('Canada');

        $this->assertDatabaseCount(Country::class, 1);
        $this->assertDatabaseCount(Province::class, 13);
    }
}