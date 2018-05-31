<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->tinyInteger('type_id')->unsigned()->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('status')->default(false);

            $table->foreign('type_id')->references('id')->on('types');
        });
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->tinyInteger('lang_id')->unsigned()->default(1);
            $table->string('title')->default('');
            $table->string('decription')->default('');
            $table->string('meta_tag_title')->default('');
            $table->string('meta_tag_decription')->default('');
            $table->string('meta_tag_keywords')->default('');

            $table->foreign('lang_id')->references('id')->on('languages');
        });
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('module')->default('');
        });
        Schema::create('pages_contents', function (Blueprint $table) {
            $table->tinyInteger('page_id')->unsigned();
            $table->tinyInteger('content_id')->unsigned()->unique();

            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('content_id')->references('id')->on('contents');
        });
        Schema::create('contents_modules', function (Blueprint $table) {
            $table->tinyInteger('content_id')->unsigned();
            $table->tinyInteger('module_id')->unsigned()->unique();

            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('module_id')->references('id')->on('modules');
        });
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('type')->unique();
        });
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('language')->unique();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        // insert admin
        DB::table('users')->insert(
            array(
                'email' => 'admin',
                'name' => 'admin',
                'password' => '$2y$10$/UB25CPnTCFmQhO0xOnM5elHuMVeNA2AGFha6Qdih1dv/69uqi7hG'
            )
        );

        // insert types
        DB::table('types')->insert(array('type' => 'standard'));
        DB::table('types')->insert(array('type' => 'home'));
        DB::table('types')->insert(array('type' => 'about'));
        DB::table('types')->insert(array('type' => 'contact'));
        DB::table('types')->insert(array('type' => 'works'));
        DB::table('types')->insert(array('type' => 'team'));

        // insert languages
        DB::table('languages')->insert(array('language' => 'en'));
        DB::table('languages')->insert(array('language' => 'uk'));
        DB::table('languages')->insert(array('language' => 'ru'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('types');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('pages_contents');
        Schema::dropIfExists('contents_modules');
    }
}
