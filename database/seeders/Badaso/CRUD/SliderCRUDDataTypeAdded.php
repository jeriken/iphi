<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class SliderCRUDDataTypeAdded extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        \DB::beginTransaction();

        try {

            $data_type = Badaso::model('DataType')->where('name', 'slider')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'slider')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 9,
                'name' => 'slider',
                'slug' => 'slider',
                'display_name_singular' => 'Slider',
                'display_name_plural' => 'Slider',
                'icon' => 'aspect_ratio',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => NULL,
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'is_maintenance' => 0,
                'description' => NULL,
                'details' => NULL,
                'notification' => '[]',
                'is_soft_delete' => false,
                'created_at' => '2022-06-14T15:51:02.000000Z',
                'updated_at' => '2022-06-14T15:51:33.000000Z',
            ));

            Badaso::model('Permission')->generateFor('slider');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/slider')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Slider',
                    'target' => '_self',
                    'icon_class' => 'aspect_ratio',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_slider',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/slider';
                $menu_item->title = 'Slider';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'aspect_ratio';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_slider';
                $menu_item->order = $order;
                $menu_item->save();
            }

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

           throw new Exception('Exception occur ' . $e);
        }
    }
}
