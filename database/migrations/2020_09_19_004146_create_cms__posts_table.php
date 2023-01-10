<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms__posts', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->text('slug')->nullable();
            $table->string('post_type')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_sticky')->default(0);
            $table->smallInteger('sort_order')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('view_count')->default(0);
            $table->nullableMorphs('author');
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('cms__posts');
    }
}
