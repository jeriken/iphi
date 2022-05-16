<?php

namespace App\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;
use Uasoft\Badaso\Module\Post\Models\Comment;

class CommentWidget implements WidgetInterface
{
    /**
     * Set permission for widget
     * set null to allow all role
     * multiple permission allowed, separate by comma.
     */
    public function getPermissions()
    {
        return 'browse_comments';
    }

    public function run($params = null)
    {
        return [
            'label' => 'Komentar',
            'icon' => 'person',
            'value' => Comment::count(),
        ];
    }
}
