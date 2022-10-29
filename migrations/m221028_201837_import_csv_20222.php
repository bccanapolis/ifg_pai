<?php

use yii\db\Migration;

/**
 * Class m221028_201837_import_csv
 */
class m221028_201837_import_csv_20222 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


//        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./scriptsql/nota_aluno_202210041243.xlsx");
        $csv = array_map('str_getcsv', file('./scriptsql/alunos_20222.csv'));

        print_r($csv[0]);

//        $cod_campus = $this->get_column($csv, 13);
//        $nome_campus = $this->get_column($csv, 14);
//
//        $codnome_campus = array_combine($cod_campus, $nome_campus);

//        print_r($codnome_campus);

        $codnome_curso_campus = $this->get_column($csv, 13, 15, 12);

        $codnome_curso_campus = array_map("unserialize", array_unique(array_map("serialize", $codnome_curso_campus))); # cursos unicos por campus

        $campus_1 = $this->array_filter_key_value($codnome_curso_campus, 1, 559);

        print_r($campus_1);

//        $cod_disciplina = $this->get_column($csv, 9)['values'];
//        $nome_disciplina = $this->get_column($csv, 1)['values'];
//
//        $codnome_disciplina = array_combine($cod_disciplina, $nome_disciplina);
//        print_r($codnome_disciplina);
//        $unique_cod_disciplina = array_unique($cod_disciplina['values']);


        return false;
    }


    private function get_column($arr, ...$columns): array
    {
        $values = [];

        if (count($columns) == 1) {
            foreach ($arr as $key => $value) {
                if ($key == 0) {
                    continue;
                }

                $values[] = $value[$columns[0]];
            }

            return $values;
        }

        foreach ($arr as $key => $value) {
            if ($key == 0) {
                continue;
            }

            $row = [];
            foreach ($columns as $col) {
                $row[] = $value[$col];
            }
            $values[] = $row;
        }


        return $values;
    }

    private function array_filter_key_value($array, $key, $keyValue)
    {
        return array_filter($array, function ($value) use ($key, $keyValue) {
            return $value[$key] == $keyValue;
        });
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221028_201837_import_csv cannot be reverted.\n";

        return false;
    }

    private function array_merge_by_axis(...$arr): array
    {
        $final = [];

        foreach ($arr[0] as $index => $a) {
            $row = [];
            foreach ($arr as $b) {
                $row[] = $b[$index];
            }

            $final[] = $row;
        }

        return $final;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221028_201837_import_csv cannot be reverted.\n";

        return false;
    }
    */
}
