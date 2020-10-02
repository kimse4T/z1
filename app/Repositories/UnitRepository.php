<?php namespace App\Repositories;

use App\Unit;
use Illuminate\Database\Eloquent\Model;

class UnitRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
        //return 'Hello';
    }

    // create a new record in the database
    public function create($request,$property_id)
    {
        if(isset($request->unit_name)){
            $index=0;
        foreach($request->unit_name as $unit_name){
            $unit = new $this->model();
            $unit->property_id=$property_id;
            $unit->owner_id=$request->owner_id;
            $unit->name=$unit_name;
            $unit->width=$request->unit_width[$index];
            $unit->length=$request->unit_length[$index];
            $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
            $unit->completion_year=$request->unit_completion_year[$index];
            $unit->useful_life=$request->unit_useful_life[$index];
            $unit->effective_age=$request->unit_effective_age[$index];
            $unit->cost_estimate=$request->unit_cost_estimates[$index];
            $unit->stories=$request->unit_storey[$index];
            $unit->bedroom=$request->unit_bedroom[$index];
            $unit->bathroom=$request->unit_bathroom[$index];
            $unit->livingroom=$request->unit_livingroom[$index];
            $unit->dinningroom=$request->unit_dinningroom[$index];
            $unit->floor=$request->unit_floor[$index];
            $unit->car_parking=$request->unit_car_parking[$index];
            $unit->motor_parking=$request->unit_motor_parking[$index];
            $unit->contact_id=$request->contact_id;
            $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
            $unit->net_floor_area=$request->unit_net_floor_area[$index];
            $unit->balcony=$request->unit_balcony[$index];
            $unit->kitchen=$request->unit_kitchen[$index];
            $unit->swimming_pool=$request->unit_swimming_pool[$index];
            $unit->security=$request->unit_security[$index];
            $unit->fitness_gym=$request->unit_fitness_gym[$index];
            $unit->lift=$request->unit_lift[$index];
            $unit->style=$request->unit_style[$index];
            $unit->save();
            $index++;
        };
        }

    }


    // update record in the database
    public function update($request,$id)
    {
        if(isset($request->unit_name)){
            $index=0;
        if(count($request->unit_name)>=count($id)){
            foreach($request->unit_name as $unit_name){
                if(isset($id[$index])){
                    if (in_array($id[$index], $request->unit_id)) {
                        $unit = $this->model->find($id[$index]);
                        $unit->owner_id=$request->owner_id;
                        $unit->name=$unit_name;
                        $unit->width=$request->unit_width[$index];
                        $unit->length=$request->unit_length[$index];
                        $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
                        $unit->completion_year=$request->unit_completion_year[$index];
                        $unit->useful_life=$request->unit_useful_life[$index];
                        $unit->effective_age=$request->unit_effective_age[$index];
                        $unit->cost_estimate=$request->unit_cost_estimates[$index];
                        $unit->stories=$request->unit_storey[$index];
                        $unit->bedroom=$request->unit_bedroom[$index];
                        $unit->bathroom=$request->unit_bathroom[$index];
                        $unit->livingroom=$request->unit_livingroom[$index];
                        $unit->dinningroom=$request->unit_dinningroom[$index];
                        $unit->floor=$request->unit_floor[$index];
                        $unit->car_parking=$request->unit_car_parking[$index];
                        $unit->motor_parking=$request->unit_motor_parking[$index];
                        $unit->contact_id=$request->contact_id;
                        $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
                        $unit->net_floor_area=$request->unit_net_floor_area[$index];
                        $unit->balcony=$request->unit_balcony[$index];
                        $unit->kitchen=$request->unit_kitchen[$index];
                        $unit->swimming_pool=$request->unit_swimming_pool[$index];
                        $unit->security=$request->unit_security[$index];
                        $unit->fitness_gym=$request->unit_fitness_gym[$index];
                        $unit->lift=$request->unit_lift[$index];
                        $unit->style=$request->unit_style[$index];
                        $unit->save();
                    }else{
                        $unit = $this->model->find($id[$index]);
                        $unit->delete();
                    }
                    if(empty($request->unit_id[$index])){
                        $unit = new $this->model();
                        $unit->property_id= $this->model->find($id[0])->property_id;
                        $unit->owner_id=$request->owner_id;
                        $unit->name=$unit_name;
                        $unit->width=$request->unit_width[$index];
                        $unit->length=$request->unit_length[$index];
                        $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
                        $unit->completion_year=$request->unit_completion_year[$index];
                        $unit->useful_life=$request->unit_useful_life[$index];
                        $unit->effective_age=$request->unit_effective_age[$index];
                        $unit->cost_estimate=$request->unit_cost_estimates[$index];
                        $unit->stories=$request->unit_storey[$index];
                        $unit->bedroom=$request->unit_bedroom[$index];
                        $unit->bathroom=$request->unit_bathroom[$index];
                        $unit->livingroom=$request->unit_livingroom[$index];
                        $unit->dinningroom=$request->unit_dinningroom[$index];
                        $unit->floor=$request->unit_floor[$index];
                        $unit->car_parking=$request->unit_car_parking[$index];
                        $unit->motor_parking=$request->unit_motor_parking[$index];
                        $unit->contact_id=$request->contact_id;
                        $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
                        $unit->net_floor_area=$request->unit_net_floor_area[$index];
                        $unit->balcony=$request->unit_balcony[$index];
                        $unit->kitchen=$request->unit_kitchen[$index];
                        $unit->swimming_pool=$request->unit_swimming_pool[$index];
                        $unit->security=$request->unit_security[$index];
                        $unit->fitness_gym=$request->unit_fitness_gym[$index];
                        $unit->lift=$request->unit_lift[$index];
                        $unit->style=$request->unit_style[$index];
                        $unit->save();
                    }

                }else{
                    $unit = new $this->model();
                    $unit->property_id= $this->model->find($id[0])->property_id;
                    $unit->owner_id=$request->owner_id;
                    $unit->name=$unit_name;
                    $unit->width=$request->unit_width[$index];
                    $unit->length=$request->unit_length[$index];
                    $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
                    $unit->completion_year=$request->unit_completion_year[$index];
                    $unit->useful_life=$request->unit_useful_life[$index];
                    $unit->effective_age=$request->unit_effective_age[$index];
                    $unit->cost_estimate=$request->unit_cost_estimates[$index];
                    $unit->stories=$request->unit_storey[$index];
                    $unit->bedroom=$request->unit_bedroom[$index];
                    $unit->bathroom=$request->unit_bathroom[$index];
                    $unit->livingroom=$request->unit_livingroom[$index];
                    $unit->dinningroom=$request->unit_dinningroom[$index];
                    $unit->floor=$request->unit_floor[$index];
                    $unit->car_parking=$request->unit_car_parking[$index];
                    $unit->motor_parking=$request->unit_motor_parking[$index];
                    $unit->contact_id=$request->contact_id;
                    $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
                    $unit->net_floor_area=$request->unit_net_floor_area[$index];
                    $unit->balcony=$request->unit_balcony[$index];
                    $unit->kitchen=$request->unit_kitchen[$index];
                    $unit->swimming_pool=$request->unit_swimming_pool[$index];
                    $unit->security=$request->unit_security[$index];
                    $unit->fitness_gym=$request->unit_fitness_gym[$index];
                    $unit->lift=$request->unit_lift[$index];
                    $unit->style=$request->unit_style[$index];
                    $unit->save();
                }

                $index++;
            };
        }else{
            foreach($id as $i){
                if(isset($id[$index])){
                    if (in_array($id[$index], $request->unit_id)) {
                        $unit = $this->model->find($id[$index]);
                        $unit->owner_id=$request->owner_id;
                        $unit->name=$request->unit_name[$index];
                        $unit->width=$request->unit_width[$index];
                        $unit->length=$request->unit_length[$index];
                        $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
                        $unit->completion_year=$request->unit_completion_year[$index];
                        $unit->useful_life=$request->unit_useful_life[$index];
                        $unit->effective_age=$request->unit_effective_age[$index];
                        $unit->cost_estimate=$request->unit_cost_estimates[$index];
                        $unit->stories=$request->unit_storey[$index];
                        $unit->bedroom=$request->unit_bedroom[$index];
                        $unit->bathroom=$request->unit_bathroom[$index];
                        $unit->livingroom=$request->unit_livingroom[$index];
                        $unit->dinningroom=$request->unit_dinningroom[$index];
                        $unit->floor=$request->unit_floor[$index];
                        $unit->car_parking=$request->unit_car_parking[$index];
                        $unit->motor_parking=$request->unit_motor_parking[$index];
                        $unit->contact_id=$request->contact_id;
                        $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
                        $unit->net_floor_area=$request->unit_net_floor_area[$index];
                        $unit->balcony=$request->unit_balcony[$index];
                        $unit->kitchen=$request->unit_kitchen[$index];
                        $unit->swimming_pool=$request->unit_swimming_pool[$index];
                        $unit->security=$request->unit_security[$index];
                        $unit->fitness_gym=$request->unit_fitness_gym[$index];
                        $unit->lift=$request->unit_lift[$index];
                        $unit->style=$request->unit_style[$index];
                        $unit->save();
                    }else{
                        $unit = $this->model->find($id[$index]);
                        $unit->delete();
                    }
                    if(empty($request->unit_id[$index])){
                        $unit = new $this->model();
                        $unit->property_id= $this->model->find($id[0])->property_id;
                        $unit->owner_id=$request->owner_id;
                        $unit->name=$request->unit_name;
                        $unit->width=$request->unit_width[$index];
                        $unit->length=$request->unit_length[$index];
                        $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
                        $unit->completion_year=$request->unit_completion_year[$index];
                        $unit->useful_life=$request->unit_useful_life[$index];
                        $unit->effective_age=$request->unit_effective_age[$index];
                        $unit->cost_estimate=$request->unit_cost_estimates[$index];
                        $unit->stories=$request->unit_storey[$index];
                        $unit->bedroom=$request->unit_bedroom[$index];
                        $unit->bathroom=$request->unit_bathroom[$index];
                        $unit->livingroom=$request->unit_livingroom[$index];
                        $unit->dinningroom=$request->unit_dinningroom[$index];
                        $unit->floor=$request->unit_floor[$index];
                        $unit->car_parking=$request->unit_car_parking[$index];
                        $unit->motor_parking=$request->unit_motor_parking[$index];
                        $unit->contact_id=$request->contact_id;
                        $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
                        $unit->net_floor_area=$request->unit_net_floor_area[$index];
                        $unit->balcony=$request->unit_balcony[$index];
                        $unit->kitchen=$request->unit_kitchen[$index];
                        $unit->swimming_pool=$request->unit_swimming_pool[$index];
                        $unit->security=$request->unit_security[$index];
                        $unit->fitness_gym=$request->unit_fitness_gym[$index];
                        $unit->lift=$request->unit_lift[$index];
                        $unit->style=$request->unit_style[$index];
                        $unit->save();
                    }
                }else{
                    $unit = new $this->model();
                    $unit->property_id= $this->model->find($id[0])->property_id;
                    $unit->owner_id=$request->owner_id;
                    $unit->name=$request->unit_name;
                    $unit->width=$request->unit_width[$index];
                    $unit->length=$request->unit_length[$index];
                    $unit->area=$request->unit_width[$index]*$request->unit_length[$index];
                    $unit->completion_year=$request->unit_completion_year[$index];
                    $unit->useful_life=$request->unit_useful_life[$index];
                    $unit->effective_age=$request->unit_effective_age[$index];
                    $unit->cost_estimate=$request->unit_cost_estimates[$index];
                    $unit->stories=$request->unit_storey[$index];
                    $unit->bedroom=$request->unit_bedroom[$index];
                    $unit->bathroom=$request->unit_bathroom[$index];
                    $unit->livingroom=$request->unit_livingroom[$index];
                    $unit->dinningroom=$request->unit_dinningroom[$index];
                    $unit->floor=$request->unit_floor[$index];
                    $unit->car_parking=$request->unit_car_parking[$index];
                    $unit->motor_parking=$request->unit_motor_parking[$index];
                    $unit->contact_id=$request->contact_id;
                    $unit->gross_floor_area=$request->unit_gross_floor_area[$index];
                    $unit->net_floor_area=$request->unit_net_floor_area[$index];
                    $unit->balcony=$request->unit_balcony[$index];
                    $unit->kitchen=$request->unit_kitchen[$index];
                    $unit->swimming_pool=$request->unit_swimming_pool[$index];
                    $unit->security=$request->unit_security[$index];
                    $unit->fitness_gym=$request->unit_fitness_gym[$index];
                    $unit->lift=$request->unit_lift[$index];
                    $unit->style=$request->unit_style[$index];
                    $unit->save();
                }

                $index++;
            };
        }
        }


    }

    // // remove record from the database
    // public function delete($id)
    // {
    //     return $this->model->destroy($id);
    // }

    // // show the record with the given id
    // public function show($id)
    // {
    //     return $this->model-findOrFail($id);
    // }

    // // Get the associated model
    // public function getModel()
    // {
    //     return $this->model;
    // }

    // // Set the associated model
    // public function setModel($model)
    // {
    //     $this->model = $model;
    //     return $this;
    // }

    // // Eager load database relationships
    // public function with($relations)
    // {
    //     return $this->model->with($relations);
    // }
}
