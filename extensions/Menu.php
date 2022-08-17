<?php

namespace app\extensions;

use yii\helpers\Html;

class Menu extends \yii\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $labelTemplate = '{label}';

    /**
     * @inheritdoc
     *
     * <a href="<?= Url::to(['/aluno/index']) ?>" class="waves-effect">
     * <i class="fa fa-graduation-cap" aria-hidden="true"></i>Aluno
     * </a>
     *
     */

    public $linkTemplate = '<a href="{url}" class="waves-effect">{icon}{label}</a>';

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class=\"nav\" id=\"side-menu\">\n{items}\n</ul>\n";

    /**
     * @inheritdoc
     */
    public $activateParents = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, 'nav');
        $this->options['id'] = 'side-menu';
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        if (empty($item['url']))
            $item['url'] = "javascript:void(0);";


        $renderedItem = parent::renderItem($item);
        $badgeOptions = null;
        return strtr(
            $renderedItem,
            [
                '{icon}' => isset($item['icon'])
                    ? "<i class='fa {$item["icon"]}' aria-hidden='true'></i>"
                    : '',
            ]
        );
    }
}
