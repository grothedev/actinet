<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('comments', function(Blueprint $table) {
      // These columns are needed for Baum's Nested Set implementation to work.
      // Column names may be changed, but they *must* all exist and be modified
      // in the model.
      // Take a look at the model scaffold comments for details.
      // We add indexes on parent_id, lft, rgt columns by default.
      $table->increments('id');
      $table->integer('parent_id')->nullable()->index();
      $table->integer('lft')->nullable()->index();
      $table->integer('rgt')->nullable()->index();
      $table->integer('depth')->nullable();

      // Add needed columns here (f.ex: name, slug, path, etc.)
      $table->text('text', 4096);
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();

      $table->integer('post_id')->unsigned();

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('comments');
  }

}