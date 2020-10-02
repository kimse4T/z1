<?php namespace App\Repositories;

use App\PropertyTitleDeed;
use Illuminate\Database\Eloquent\Model;

class PropertyTitleDeedRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(PropertyTitleDeed $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        // return $this->model->all();
        return 'Hello';
    }

    // create a new record in the database
    public function create($request,$property_id)
    {
        $title_deed_arr = json_decode($request->propertyTitleDeedRepeatable);
        // $title_deeds = (array)$title_deed_arr[0];
        // $title_deeds['property_id'] = $property_id;

        // return $this->model->create($title_deeds);
        //dd($title_deed_arr);
        foreach($title_deed_arr as $title_deed){
            $title = new $this->model();
            $title->property_id=$property_id;
            $title->title_deed_type=$title_deed->title_deed_type;
            $title->title_deed_no=$title_deed->title_deed_no;
            $title->issued_year=$title_deed->issued_year;
            $title->parcel_no=$title_deed->parcel_no;
            $title->image=$title_deed->title_deed_image;
            $title->save();
        };
    }


    // update record in the database
    public function update($request, $id,$property_id)
    {
        $title_deed_arr = json_decode($request->propertyTitleDeedRepeatable);
        $title_id=array();
        foreach($title_deed_arr as $value){
            array_push($title_id,$value->id);
        }
        $index=0;
        if(count($title_deed_arr)>=count($id)){
            foreach($title_deed_arr as $title_deed){
                if(isset($id[$index])){
                    if (in_array($id[$index], $title_id)) {
                        $title = $this->model->find($id[$index]);
                        $title->title_deed_type=$title_deed->title_deed_type;
                        $title->title_deed_no=$title_deed->title_deed_no;
                        $title->issued_year=$title_deed->issued_year;
                        $title->parcel_no=$title_deed->parcel_no;
                        $title->image=$title_deed->title_deed_image;
                        $title->save();
                    }else{
                        $unit = $this->model->find($id[$index]);
                        $unit->delete();
                    }
                    if(empty($title_id[$index])){
                        $title = new $this->model();
                        $title->property_id=$property_id;
                        $title->title_deed_type=$title_deed->title_deed_type;
                        $title->title_deed_no=$title_deed->title_deed_no;
                        $title->issued_year=$title_deed->issued_year;
                        $title->parcel_no=$title_deed->parcel_no;
                        $title->image=$title_deed->title_deed_image;
                        $title->save();
                    }

                }else{
                    $title = new $this->model();
                    $title->property_id=$property_id;
                    $title->title_deed_type=$title_deed->title_deed_type;
                    $title->title_deed_no=$title_deed->title_deed_no;
                    $title->issued_year=$title_deed->issued_year;
                    $title->parcel_no=$title_deed->parcel_no;
                    $title->image=$title_deed->title_deed_image;
                    $title->save();
                }

                $index++;
            };
        }else{
            foreach($id as $i){
                if(isset($id[$index])){
                    if (in_array($id[$index],  $title_id)) {
                        $title = $this->model->find($id[$index]);
                        $title->title_deed_type= $title_deed_arr[$index]->title_deed_type;
                        $title->title_deed_no=$title_deed_arr[$index]->title_deed_no;
                        $title->issued_year=$title_deed_arr[$index]->issued_year;
                        $title->parcel_no=$title_deed_arr[$index]->parcel_no;
                        $title->image=$title_deed_arr[$index]->title_deed_image;
                        $title->save();
                    }else{
                        $unit = $this->model->find($id[$index]);
                        $unit->delete();
                    }
                    if(empty($title_id[$index])){
                        $title = new $this->model();
                        $title->property_id=$property_id;
                        $title->title_deed_type=$title_deed_arr[$index]->title_deed_type;
                        $title->title_deed_no=$title_deed_arr[$index]->title_deed_no;
                        $title->issued_year=$title_deed_arr[$index]->issued_year;
                        $title->parcel_no=$title_deed_arr[$index]->parcel_no;
                        $title->image=$title_deed_arr[$index]->title_deed_image;
                        $title->save();
                    }

                }else{
                    $title = new $this->model();
                    $title->property_id=$property_id;
                    $title->title_deed_type=$title_deed_arr[$index]->title_deed_type;
                    $title->title_deed_no=$title_deed_arr[$index]->title_deed_no;
                    $title->issued_year=$title_deed_arr[$index]->issued_year;
                    $title->parcel_no=$title_deed_arr[$index]->parcel_no;
                    $title->image=$title_deed_arr[$index]->title_deed_image;
                    $title->save();
                }

                $index++;
            };
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
