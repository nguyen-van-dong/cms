<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('cms__pages', function (Blueprint $table) {
      $table->nestedSet();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('cms__pages', function (Blueprint $table) {
      $table->dropColumn('parent_id');
      $table->dropColumn('_lft');
      $table->dropColumn('_rgt');
    });
  }
};
