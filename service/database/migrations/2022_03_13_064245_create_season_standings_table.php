<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('goals')->default(0);
            $table->unsignedTinyInteger('goals_conceded')->default(0);
            $table->unsignedTinyInteger('plays')->default(0);
            $table->unsignedTinyInteger('wins')->default(0);
            $table->unsignedTinyInteger('draws')->default(0);
            $table->unsignedTinyInteger('loses')->default(0);
            $table->float('chance')->default(0);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE public.season_standings ADD COLUMN points integer GENERATED ALWAYS AS (wins * 3 + draws) STORED');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_teams');
    }
};
