<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="panel panel-default">
        <div class="panel-body">

            <?= DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute'=>'status',
                        'value'=>User::getStatusValue($model->status),
                    ],
                    'username',
                    [
                        'attribute'=>'email',
                        'value'=>$model->email,
                        'format'=>'email',
                        'visible'=>User::hasPermission('viewUserEmail'),
                    ],
                    [
                        'attribute'=>'email_confirmed',
                        'value'=>$model->email_confirmed,
                        'format'=>'boolean',
                        'visible'=>User::hasPermission('viewUserEmail'),
                    ],
                    [
                        'label'=>UserManagementModule::t('back', 'Roles'),
                        'value'=>implode('<br>', ArrayHelper::map(Role::getUserRoles($model->id), 'name', 'description')),
                        'visible'=>User::hasPermission('viewUserRoles'),
                        'format'=>'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>

        </div>
    </div>
</div>
