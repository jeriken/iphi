<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class HalamanCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'halaman')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'halaman')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'id' => 3,
                'name' => 'halaman',
                'slug' => 'halaman',
                'display_name_singular' => 'Halaman',
                'display_name_plural' => 'Halaman',
                'icon' => 'layers',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\HalamanController',
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
                'created_at' => '2022-05-11T04:30:59.000000Z',
                'updated_at' => '2022-06-10T16:48:48.000000Z',
            ));

            Badaso::model('Permission')->generateFor('halaman');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/halaman')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Halaman',
                    'target' => '_self',
                    'icon_class' => 'layers',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_halaman',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/halaman';
                $menu_item->title = 'Halaman';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'layers';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_halaman';
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
