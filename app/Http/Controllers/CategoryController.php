<?php

namespace App\Http\Controllers;
use App\Traits\UploadPhoto;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function addCategory(CategoryRequest $request ){

        //$fileName=$this->UploadPhoto($request->file('photo') , 'images/category');
        $category=Category::create([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'photo'       => $request->get('photo')
           // 'photo'       => $fileName,
        ]      
        );
       
        
        return response()->json(compact('category'));
    }

    public function getCategory(){
        $categories=Category::paginate(5);
        return response()->json(compact('categories'));
    }

    public function deleteCategory($id){
        $categories=Category::find($id);
        $categories->delete();
    }

    public function updateCategory(CategoryRequest $request ,$id){

        $category=Category::find($id);
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return response()->json(compact('category'));

    }

    public function editCategory($id){
        $category=Category::find($id);
        return response()->json(compact('category'));
    }
}
