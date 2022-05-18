<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Models\MenuItem;

class KasCRUDDataTypeAdded extends Seeder
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

            $data_type = Badaso::model('DataType')->where('name', 'kas')->first();

            if ($data_type) {
                Badaso::model('DataType')->where('name', 'kas')->delete();
            }

            \DB::table('badaso_data_types')->insert(array (
                'name' => 'kas',
                'slug' => 'kas',
                'display_name_singular' => 'Kas',
                'display_name_plural' => 'Kas',
                'icon' => 'attach_money',
                'model_name' => NULL,
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\KasController',
                'order_column' => NULL,
                'order_display_column' => NULL,
                'order_direction' => NULL,
                'generate_permissions' => true,
                'server_side' => false,
                'description' => NULL,
                'details' => NULL,
                'notification' => '[]',
                'is_soft_delete' => false,
                'updated_at' => '2022-05-18T15:44:51.000000Z',
                'created_at' => '2022-05-18T15:44:51.000000Z',
                'id' => 7,
            ));

            Badaso::model('Permission')->generateFor('kas');

            $menu = Badaso::model('Menu')->where('key', config('badaso.default_menu'))->firstOrFail();

            $menu_item = Badaso::model('MenuItem')
                ->where('menu_id', $menu->id)
                ->where('url', '/general/kas')
                ->first();

            $order = Badaso::model('MenuItem')->highestOrderMenuItem($menu->id);

            if (!is_null($menu_item)) {
                $menu_item->fill([
                    'title' => 'Kas',
                    'target' => '_self',
                    'icon_class' => 'attach_money',
                    'color' => null,
                    'parent_id' => null,
                    'permissions' => 'browse_kas',
                    'order' => $order,
                ])->save();
            } else {
                $menu_item = new MenuItem();
                $menu_item->menu_id = $menu->id;
                $menu_item->url = '/general/kas';
                $menu_item->title = 'Kas';
                $menu_item->target = '_self';
                $menu_item->icon_class = 'attach_money';
                $menu_item->color = null;
                $menu_item->parent_id = null;
                $menu_item->permissions = 'browse_kas';
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
