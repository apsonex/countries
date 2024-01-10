<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('capital', 255)->nullable();
            $table->string('citizenship', 255)->nullable();
            $table->string('country_code', 3)->default('');
            $table->string('currency', 255)->nullable();
            $table->string('currency_code', 255)->nullable();
            $table->string('currency_sub_unit', 255)->nullable();
            $table->string('currency_symbol', 4)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('iso_3166_2', 2)->nullable();
            $table->string('iso_3166_3', 3)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('region_code', 3)->nullable();
            $table->string('sub_region_code', 3)->nullable();
            $table->boolean('eea')->default(0);
            $table->string('calling_code', 3)->nullable();
            $table->string('flag', 6)->nullable();
            $table->timestamps();
        });

        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
            $table->string('slug');
            $table->json('taxes')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['slug', 'country_id']);
        });

        //        if (!app()->environment(['testing'])) {
        //            \Illuminate\Support\Facades\Artisan::call('seed:countries canada');
        //        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
