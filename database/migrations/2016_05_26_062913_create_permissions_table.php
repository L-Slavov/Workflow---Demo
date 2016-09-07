<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',128)->unique();
            # Създаване на акаути във всички контрагенти
            $table->boolean('create_user_LyuboINC');
            # Създаване на акаунт само в собствения контрагент
            $table->boolean('create_user_partner');
            # Редактиране на всички потребители
            $table->boolean('edit_user_LyuboINC');
            # Редактиране на потребители от контрагент
            $table->boolean('edit_user_partner');
            # Разглеждане на всички заявки
            $table->boolean('view_tasks_LyuboINC');
            # Разглеждане на заявки само за контрагента
            $table->boolean('view_tasks_partner');
            # Разглеждане само на собствени заявки
            $table->boolean('view_tasks_self');
            # Статус на заявка
            $table->boolean('edit_tasks_status');   
            # Създава заявки
            $table->boolean('create_tasks');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions');
    }
}
