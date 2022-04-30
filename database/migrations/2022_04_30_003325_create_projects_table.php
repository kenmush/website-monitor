<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->longText('url');
            $table->foreignIdFor(User::class);
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}