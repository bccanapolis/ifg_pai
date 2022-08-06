<?php
use kartik\grid\GridView;
use yii\helpers\Html;

/**
 * @var $notas array
 */
$this->title = 'Normalização de Notas ' . date('Y');
?>

<?php
echo GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // Simple columns defined by the data contained in $dataProvider.
        // Data from the model's column will be used.
        'matricula',
        'nome',
        'acertos',
        'nota',
        'disciplina_escolhida',
    ],
    'summary' => '',
    'export' => false,

    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-alternativa']],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
    ],
    'panelTemplate'=>'<div class="panel {type}">
                        {panelHeading}
                        {panelBefore}
                        <div style="padding: 20px">{items}</div>
                    </div>',
]);
?>