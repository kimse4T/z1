<?php

namespace App\Repositories;

use App\Models\Property;
use App\Repositories\BaseRepository;

/**
 * Class PropertyRepository
 * @package App\Repositories
 * @version October 6, 2020, 3:39 am UTC
*/

class PropertyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Property::class;
    }
}
