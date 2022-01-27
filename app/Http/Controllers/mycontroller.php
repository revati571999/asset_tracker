<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Hash; 
use App\Models\detail;
use App\Models\category;
use App\Models\asset_image;
use Illuminate\Support\facades\DB; 


class mycontroller extends Controller
{
    //
    public function chart(){
        $result=DB::select(DB::raw("SELECT COUNT(*) as total_asset,type FROM categories GROUP BY type"));
        $chartdata="";
        foreach($result as $list){
            $chartdata.="['".$list->type."',   ".$list->total_asset."],";

        }
        $arr['chartData']=rtrim($chartdata,",");
        return view('admin.chart',$arr);
    }
    
    public function barchart(){
        $result=DB::select(DB::raw("SELECT count(*) as activestatus,isactive FROM categories  GROUP BY isactive"));
        $chartdata="";
        foreach($result as $list){
            $chartdata.="['".$list->isactive."',   ".$list->activestatus."],";

        }
       
        $arr['chartData']=rtrim($chartdata,",");
        return view('admin.barchart',$arr);
    }
    
      
    public function product(){
        return view('product');
    }
   
    public function form1(){
        $detail=detail::paginate(1);
        return view('admin.form1',compact('detail'));
    }
    public function postform1(Request $req){
        $validateData=$req->validate([
            'name'=>'required|min:4|max:255',
            'description'=>'required| min:4|max:500'
             ],[
            'name.required'=>'plz enter Asset name  ',
            'description.required'=>'plz enter description name ',
             ]
    );
    if($validateData){
        $detail=new detail;
       $detail->name=$req->name;
       $detail->description=$req->description;
       
       $detail->save();
       $detail=detail::all();
      // return redirect(route('/home/form1'));
      return redirect('/home/form1');
    }else{
        return back()->with("errors","upload error");
    }
    }
    public function form2(){
        $detail=detail::all();
        $category=category::paginate(1);
        return view('admin.form2',compact('detail','category'));
    }
    public function postform2(Request $req){
        $validateData=$req->validate([
            'name'=>'required|min:4|max:255',
            'type'=>'required',
            'file'=>'required'
             ],[
            'name.required'=>'plz enter Asset name  ',
            'type.required'=>'plz enter type ',
             ]
    );
    if($validateData){
        $cat=detail::where('id',$req->type)->first();
        
        $name=$req->name;
        $type=$cat->name;
        $category_id=$req->type;
        $asset_id=$req->asset_id;
        $status=$req->status;
         $file=$req->file;
         
         $extension=$file->getClientOriginalExtension();

         $filename=time().'.'.$extension;
         $file->move(public_path('uploads/'),$filename);
         
  
        $category=new category();
            $category->name=$name;
            $category->type=$type;
            $category->isactive=$status;
            $category->detail_id=$category_id;
            $category->asset_id=$asset_id;
            $category->image=$filename;
            $category->save();
             return redirect('/home/form3');

            
        
    
       
    }
}
public function deleteform1($id)
{
        detail::destroy($id);
    return redirect('home/form1');
}
public function assetimage(){
$category=category::all();
return view('admin.assetimage',compact('category'));

}

public function imagepost(Request $req){
    $categories_id= $req->category_id;
    $file=$req->file('file');
    foreach($file as $i)
    {

        $extension=$i->getClientOriginalName();
        $filename=time().rand(1,100).'.'.$extension;
         $i->move(public_path('uploads/'),$filename);
         $asset_image=new asset_image();
         $asset_image->category_id=$categories_id;
         $asset_image->img_path=$filename;
         $asset_image->save();
         
       
    }
         
        
             return redirect('/home/form3');

}
public function showimage($id){
    $category=category::find($id);
     $image=$category->images;
 return view('admin.showimage',compact('image'));
}
public function deleteform2(Request $req){
    $category=category::where('id',$req->cid)->first();
    $imagePath=public_path().'/uploads/'.$category->image;
    $category=category::find($req->cid);
    if($category->delete()){
        unlink($imagePath);
        return redirect('/home/form3');
    }
    else{
        return "Product Not Deleted";
    }
}
public function editform2($id){
    $detail=detail::all();
    $category=category::find($id);
    return view('admin.editform2',compact('detail'),compact('category'));
}

public function editpost2(Request $req,$id){
    $category=category::where('id',$id)->update([
       'name'=>$req->name,'type'=>$req->type
 ]); 
      return redirect('/home/form2');
}



    public function form3(){
        $detail=detail::all();
        $category=category::paginate(2);
        return view('admin.form3',compact('detail','category'));
        
    }
    public function editform($id){
        $detail=detail::find($id);
        return view('admin.editform',compact('detail'));
    }
    public function editpost(Request $req,$id){
          $detail=detail::where('id',$id)->update([
             'name'=>$req->name,'description'=>$req->description
       ]); 
            return redirect('/home/form1');
        }

}
