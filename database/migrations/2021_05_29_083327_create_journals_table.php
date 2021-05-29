<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
                ->constrained('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('reader_id')
                ->constrained('readers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('date_take');
            $table->date('date_return');
            $table->string('status');
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
        Schema::dropIfExists('journals');
    }
}
