<?php

namespace Apsonex\Countries\Commands;

use Apsonex\Countries\Actions\SeedCountryAction;
use Apsonex\Countries\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeedCountriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:countries {countries}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Countries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        foreach (str($this->argument('countries'))->explode(',') as $country) {
            SeedCountryAction::execute($country);
        }

        return static::SUCCESS;
    }

    //    protected function seedCountryFromDir(string $dir)
    //    {
    //        $country = json_decode(File::get($dir . "/country.json"), true);
    //
    //        DB::table('countries')->insert([
    //            'capital'           => $country['capital'] ?? null,
    //            'citizenship'       => $country['citizenship'] ?? null,
    //            'country_code'      => $country['country-code'] ?? null,
    //            'currency'          => $country['currency'] ?? null,
    //            'currency_code'     => $country['currency_code'] ?? null,
    //            'currency_sub_unit' => $country['currency_sub_unit'] ?? null,
    //            'full_name'         => $country['full_name'] ?? null,
    //            'iso_3166_2'        => $country['iso_3166_2'] ?? null,
    //            'iso_3166_3'        => $country['iso_3166_3'] ?? null,
    //            'name'              => $country['name'] ?? null,
    //            'region_code'       => $country['region-code'] ?? null,
    //            'sub_region_code'   => $country['sub-region-code'] ?? null,
    //            'eea'               => (bool)$country['eea'],
    //            'calling_code'      => $country['calling_code'] ?? null,
    //            'currency_symbol'   => $country['currency_symbol'] ?? null,
    //            'flag'              => $country['flag'] ?? null,
    //        ]);
    //
    //        $country = \Apsonex\Countries\Models\Country::where('iso_3166_2', $country['iso_3166_2'])->firstOrFail();
    //
    //        $this->seedProvinces($dir, $country);
    //    }
    //
    //    protected function seedProvinces(string $dir, Country $country)
    //    {
    //        foreach (json_decode(File::get($dir . "/tax-rates.json"), true) as $abbreviation => $data) {
    //            $country->provinces()->create([
    //                'name'         => $data['name'],
    //                'abbreviation' => $abbreviation,
    //                'taxes'        => $data['taxes'],
    //                'slug'         => str($data['name'])->slug(),
    //            ]);
    //        }
    //    }
}