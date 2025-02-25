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
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->after('email')->nullable();
            $table->string('phone')->after('image');
            $table->date('birthday')->after('phone')->default('1970-01-01'); 
            $table->string('address')->after('birthday');
            $table->date('recruitment_date')->after('address');
            $table->decimal('salary', 10, 2)->after('recruitment_date');
            $table->string('status')->default('active')->after('salary');
            // $table->foreignId('role_id')->after('status')->constrained();
            // $table->foreignId('department_id')->after('role_id')->constrained();
            // $table->foreignId('company_id')->after('department_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('recruitment_date');
            $table->dropColumn('salary');
            $table->dropColumn('status');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
