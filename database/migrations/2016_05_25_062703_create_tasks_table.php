<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            # Заявка номер
            $table->increments('id');
            # Дата
            $table->timestamp('creation_date');
            # Контрагент
            $table->string('partner');
            # Заявена от
            $table->string('requested_by',128);
            # Задача
            $table->string('task_summary',1024);
            # Приоритет
            $table->tinyInteger('priority');
            # Финален срок за стартиране работа по задачата
            $table->date('latest_startingtime')->nullable();
            # Конкретно описание на задачата
            $table->string('full_task_text',4096)->nullable();
            # Какъв е възникналия казус на задачата
            $table->string('task_case',2048)->nullable();
            # За кои курсове се отнася задачата
            $table->string('affected_courses',1024)->nullable();
            # За кои потребители се отнася задачата
            $table->string('affected_users',1024)->nullable();
            # Необходимо ли е някакво предстоящо или последващо действие
            $table->string('extra_work',2048)->nullable();
            # Допълнителен коментар
            $table->string('comments',2048)->nullable();
            # Изключение (специфики свързани с потребителя или курсовете)
            $table->string('exceptions',2048)->nullable();
            # Прогнозна дата за изпълнение на задачата
            $table->date('expected_completion_time')->nullable();
            # Работа по задачата е започната на
            $table->timestamp('task_start_date')->nullable();
            # Работа по задачата е започната от
            $table->string('task_start_by',128)->nullable();
            # Завършена на
            $table->timestamp('completed_on')->nullable();
            # Завършена от
            $table->string('completed_by',128)->nullable();
            # Индентификатор
            $table->integer('task_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
