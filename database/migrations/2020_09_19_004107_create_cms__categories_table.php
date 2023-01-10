<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms__categories', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->longText('description')->nullable();
            $table->text('slug')->nullable();
            $table->boolean('is_active')->default(true);
            $table->nestedSet();
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
        Schema::dropIfExists('cms__categories');
    }
}
