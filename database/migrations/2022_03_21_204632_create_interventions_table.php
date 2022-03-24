<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories");
            $table->unsignedBigInteger("workshop_id");
            $table->foreign("workshop_id")->references("id")->on("workshops");
            $table->string('name', 150);
            $table->text('description');
            $table->float('price', 9, 2);
            $table->unsignedTinyInteger('estimated_duration');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
}
