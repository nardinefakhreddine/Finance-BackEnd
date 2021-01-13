<?php

namespace App\Http\Controllers;
use App\Traits\UploadPhoto;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\IncomeSource;

class IncomeSourceController extends Controller
{
    public function addSource(CategoryRequest $request ){

        //$fileName=$this->UploadPhoto($request->file('photo') , 'images/category');
        $source=IncomeSource::create([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'photo'       => $request->get('photo')
           // 'photo'       => $fileName,
        ]      
        );
        return response()->json(compact('source'));
    }

    public function getSource(){
        $sources=IncomeSource::paginate(5);
        return response()->json($sources);
    }

    public function deleteSource($id){
        $sources=IncomeSource::find($id);
        $sources->delete();
    }

    public function updateSource(CategoryRequest $request ,$id){

        $source=IncomeSource::find($id);
        $source->name=$request->name;
        $source->description=$request->description;
        $source->save();
        return response()->json($source);

    }

    public function editSource($id){
        $source=IncomeSource::find($id);
        return response()->json($source);
    }
}
