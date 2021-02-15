<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use DB;


class productsController extends Controller
{

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  echo "hello";
        return view('create');
    }

     public function edit(Request $request, $id)
     {

      $product= $request->all();
     // print_r($product);
    //  die();
    $update_array=array(
  'name' => $request->input('name'),
  'price' => $request->input('price'),
  'desc' => $request->input('desc'),
  'qty' => $request->input('qty'),
  'type' => $request->input('type'),
  'discount' => $request->input('discount'),
  'total' => $request->input('total')


); 
 
 
$file= $request->file('productimg');
if($file!=""){
  $newfile=time().'.'.$file->getClientOriginalName();
   $filemove= $file->move(public_path('productimg'),$newfile);
    $update_array['productimg']=$newfile;
 
}
$update= products::where('id',$id)->update($update_array);



        if(empty($update)){
            echo "0";
        }
        else{
            echo "1";
        }
        
     }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
  
      
         /*image upload in ajax */
        $file= $request->file('productimg');
          
        $newfile=time().'.'.$file->getClientOriginalName();
        $file->move(public_path('productimg'),$newfile);
//print_r($file);
//die();
      
        
     
    
         $values=$_POST;
        
       
                $products = new products;
                $products->name = $values['name'];
                $products->productimg =  $newfile;
                $products->price = $values['price'];
			        	$products->desc = $values['desc'];
                $products->qty = $values['qty'];
                $products->type = $values['type'];
                $products->discount = $values['discount'];
                $products->total = $values['total'];
                $products->save();
                if(empty($product)){
                    echo "1";
                }
                else{
                    echo "0";
                }
    
    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     function prolist()
    {


        
      $product = DB::table('products')->select( 'id','name','productimg' ,'price','desc','qty','type','discount','total')->where('status',1)->get();

     
       return view('list',compact('product'));
       //return view('list')->with('product',$product)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  
    {
      
    
    //   echo "hello".$id;
     $data = DB::table('products')->select( 'id','name','productimg', 'price','desc','qty','type','discount','total')->where('id',$id)->get();
     return view("update",["data"=>$data]);
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      
        $delete=products::find($id);
        $delete=products::where('id',$delete->id)->update(['status'=>'0']);
        if(empty($delete)){
            echo "0";
        }
        else{
            echo "1";
        }
        
    }
}