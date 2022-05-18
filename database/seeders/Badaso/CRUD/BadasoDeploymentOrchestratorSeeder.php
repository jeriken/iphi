<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Traits\Seedable;

class BadasoDeploymentOrchestratorSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = 'database/seeders/Badaso/CRUD/';

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        
        
        $this->seed(AnggotaCRUDDataDeleted::class);
        
        
        $this->seed(HalamanCRUDDataDeleted::class);
        $this->seed(HalamanCRUDDataTypeAdded::class);
        $this->seed(HalamanCRUDDataRowAdded::class);
        
        
        $this->seed(KasCRUDDataDeleted::class);
        
        
        
        
        $this->seed(KasCRUDDataTypeAdded::class);
        $this->seed(KasCRUDDataRowAdded::class);
    }
}
