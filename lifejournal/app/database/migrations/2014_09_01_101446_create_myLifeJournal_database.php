<?php
 
//
// NOTE Migration Created: 2014-09-01 10:14:46
// --------------------------------------------------
 
class CreateMylifejournalDatabase {
//
// NOTE - Make changes to the database.
// --------------------------------------------------
 
public function up()
{

//
// NOTE -- answers
// --------------------------------------------------
 
Schema::create('answers', function($table) {
 $table->increments('id')->unsigned();
 $table->string('answer', 255);
 $table->string('year', 255);
 $table->unsignedInteger('user_id');
 $table->unsignedInteger('question_id');
 $table->string('image_s', 255)->nullable();
 $table->string('image_l', 255)->nullable();
 $table->string('image_name', 60)->nullable();
 $table->timestamp('created_at')->default("0000-00-00 00:00:00");
 $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
 });


//
// NOTE -- questions
// --------------------------------------------------
 
Schema::create('questions', function($table) {
 $table->increments('id')->unsigned();
 $table->string('question', 255);
 $table->unsignedInteger('day');
 $table->string('month', 255);
 $table->timestamp('created_at')->default("0000-00-00 00:00:00");
 $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
 });


//
// NOTE -- users
// --------------------------------------------------
 
Schema::create('users', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 255);
 $table->string('email', 255);
 $table->date('birthday');
 $table->string('password', 255);
 $table->string('remember_token', 100)->nullable();
 $table->unsignedInteger('settings_all')->nullable();
 $table->string('profile_pic', 255)->nullable();
 $table->timestamp('created_at')->default("0000-00-00 00:00:00");
 $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
 });



}
 
//
// NOTE - Revert the changes to the database.
// --------------------------------------------------
 
public function down()
{

Schema::drop('answers');
Schema::drop('questions');
Schema::drop('users');

}
}