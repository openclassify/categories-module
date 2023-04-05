<?php namespace Visiosoft\CategoryFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

class CategoryFieldTypeSchema extends FieldTypeSchema
{

    /**
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function addColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        $level = $this->fieldType->configGet('level');

        for ($i = 1; $i <= $level; $i++) {

            $column_name = $this->fieldType->getColumnName() . '_' . $i;

            // Skip if the column already exists.
            if ($this->schema->hasColumn($table->getTable(), $column_name)) {
                return;
            }

            /**
             * Add the column to the table.
             *
             * @var Blueprint|Fluent $column
             */
            $column = call_user_func_array(
                [$table, 'integer'],
                array_filter(
                    [
                        $column_name,
                        $this->fieldType->getColumnLength(),
                    ]
                )
            );

            $nullable = true;

            if ($i == 1) {
                $nullable = !$assignment->isRequired();
            }

            $column->nullable($nullable);
        }
    }

    /**
     * Drop the field type column from the table.
     *
     * @param Blueprint $table
     */
    public function dropColumn(Blueprint $table)
    {

        $level = $this->fieldType->configGet('level');

        for ($i = 1; $i <= $level; $i++) {

            $column_name = $this->fieldType->getColumnName() . '_' . $i;

            // Skip if the column already exists.
            if ($this->schema->hasColumn($table->getTable(), $column_name)) {
                return;
            }

            // Drop dat 'ole column.
            $table->dropColumn($column_name);
        }
    }

}
