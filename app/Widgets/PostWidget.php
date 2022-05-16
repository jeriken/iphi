<?php

namespace App\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;
use Uasoft\Badaso\Module\Post\Models\Post as ModelsPost;

class PostWidget implements WidgetInterface
{
    /**
     * Set permission for widget
     * set null to allow all role
     * multiple permission allowed, separate by comma.
     */
    public function getPermissions()
    {
        return 'browse_posts';
    }

    public function run($params = null)
    {
        return [
            'label' => 'Postingan',
            'icon' => 'person',
            'value' => ModelsPost::count(),
        ];
    }
}
