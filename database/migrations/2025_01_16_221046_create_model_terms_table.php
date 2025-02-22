<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("model_terms", function (Blueprint $table) {
            $table->foreignId("term_id")->constrained()->onDelete("cascade");
            $table->morphs("model");
            $table->primary(["term_id", "model_id", "model_type"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("model_terms");
    }
};
