<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hostel_application_basic', function (Blueprint $table) {
            // The existing column was truncated to 'national_champtionship_documen' (30 chars)
            // Adding the full correctly-named column the code expects
            if (!Schema::hasColumn('hostel_application_basic', 'national_champtionship_document')) {
                $table->string('national_champtionship_document', 256)->nullable()->after('student_id_card');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hostel_application_basic', function (Blueprint $table) {
            $table->dropColumn('national_champtionship_document');
        });
    }
};
