<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCourseColumnAndAddForeignKeyToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Rename the 'course' column to 'course_id'
            $table->renameColumn('course', 'course_id');
        });

        // Change the data type of 'course_id' to unsigned big integer
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->change();
            // Add a foreign key constraint to the 'courses' table
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop the foreign key constraint and 'course_id' column
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });

        Schema::table('students', function (Blueprint $table) {
            // Rename 'course_id' back to 'course'
            $table->renameColumn('course_id', 'course');
        });
    }
}
