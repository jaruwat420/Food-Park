<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('subject_id');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');

            $table->foreign('status_id')
                  ->references('id')
                  ->on('ticket_statuses')
                  ->onDelete('cascade');

            $table->foreign('subject_id')
                  ->references('id')
                  ->on('ticket_subjects')
                  ->onDelete('cascade');

            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->onDelete('cascade');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');

            $table->foreign('assigned_to')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        if (Schema::hasTable('tickets')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['category_id']);
                $table->dropForeign(['status_id']);
                $table->dropForeign(['subject_id']);
                $table->dropForeign(['location_id']);
                $table->dropForeign(['department_id']);
                $table->dropForeign(['assigned_to']);
            });
        }

        Schema::dropIfExists('tickets');

        Schema::enableForeignKeyConstraints();
    }
}
