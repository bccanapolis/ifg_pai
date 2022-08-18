<?php

namespace app\extensions;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Menu extends \yii\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $labelTemplate = '<span class="hide-menu">{label}</span>';

    /**
     * @inheritdoc
     *
     * <a href="<?= Url::to(['/aluno/index']) ?>" class="waves-effect">
     * <i class="fa fa-graduation-cap" aria-hidden="true"></i>Aluno
     * </a>
     *
     */

    public $linkTemplate = '<a href="{url}" class="waves-effect waves-dark sidebar-link">{icon}{label}</a>';

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class=\"nav\" id=\"sidebarnav\">\n{items}\n</ul>\n";

    /**
     * @inheritdoc
     */
    public $activateParents = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, '');
        $this->options['id'] = 'sidebarnav';
        parent::init();
    }

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', ['class'=>'sidebar-item']));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
//        if (empty($item['url']))
//            $item['url'] = "javascript:void(0);";
//
//
//        $renderedItem = parent::renderItem($item);
//        $badgeOptions = null;
//        return strtr(
//            $renderedItem,
//            [
//                '{icon}' => isset($item['icon'])
//                    ? "<i class='fa {$item["icon"]}' aria-hidden='true'></i>"
//                    : '',
//            ]
//        );

        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{icon}' => isset($item['icon'])
                    ? "<i class='fa {$item["icon"]}' aria-hidden='true'></i>"
                    : '',
                '{label}' => $item['label'],
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{icon}' => isset($item['icon'])
                    ? "<i class='fa {$item["icon"]}' aria-hidden='true'></i>"
                    : '',
            '{label}' => $item['label'],

        ]);
    }
}
