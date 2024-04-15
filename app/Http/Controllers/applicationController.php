<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\products;
use App\Models\categories;
use App\Models\department;
use App\Models\staff;
use App\Models\issue_item;
use Carbon\Carbon;

class applicationController extends Controller
{
   
   

 
public function addStaff (Request  $request){

    try {
        $request->validate([
          'name'=>'required',
          'contact'=>'required|numeric|digits:10',
          'category'=>'required',
          
        ]);

        $staff = new staff();

        $staff->name=$request->input('name');
        $staff->contact= $request->input('contact');
        $staff->category=$request->input('category');
        $staff->designation=$request->input('designation');
         
        $staff->save();
         return response()->json(['message'=>'STAFF ADDED SUCCESSFULLY']);

    } catch(QueryException $e){
        return response()->json(['error' => 'Database Error:user with same phone number already entered check and try again!!'], 500);
    } catch(\Exception $e) {
      return response()->json(['error'=>'An error occured:'.$e->getMessage()],500);

    }
}


public function editStaff (Request  $request, $id){

    try {
        $request->validate([
          'name'=>'required',
          'contact'=>'required|numeric',
          'category'=>'required',
          
        ]);

        $staff =staff::find($id);

        $staff->name=$request->input('name');
        $staff->contact= $request->input('contact');
        $staff->category=$request->input('category');
        $staff->designation=$request->input('designation');
         
        $staff->save();
         return response()->json(['message'=>'STAFF ADDED SUCCESSFULLY']);

    } catch(QueryException $e){
        return response()->json(['error' => 'Database Error:user with same phone number already entered check and try again!!'], 500);
    } catch(\Exception $e) {
      return response()->json(['error'=>'An error occured:'.$e->getMessage()],500);

    }
}


public function getStaff(){
    $staff=staff::all();
    return response()->json(['data'=>$staff]);
}

public function deleteStaff($id){
 $staff=staff::find($id);

$staff->delete();
return response()->json(['message'=>'Staff deleted successfully']);

}



    public function getSuppliers(){
        $suppliers=suppliers::all();
        return response()->json(['data'=>$suppliers]);

    }

    public function addProduct(Request $request)
    {
        
        //return redirect()->route('suppliers.create')->with('success', 'Supplier added successfully.');
    
        try {

            $request->validate([
                'name' => 'required|string|max:30',
                'color' => 'required|max:30',
                'size' => 'required|max:30',
                'gender' => 'required|max:30',
                'quantity' => 'required|max:20',
                'category'=>'required',
                'unitprice'=>'required|numeric',
                'description'=>'required|string|max:255',

               // 'price' => 'required',
               // 'description' => 'required|numeric|digits:10',
               // 'email' => 'required|string|max:255', 
            ]); 
    
            $product = new products();
            $product->name = $request->input('name');
            $product->color = $request->input('color');
            $product->size = $request->input('size');
            $product->gender = $request->input('gender');
            $product->type = $request->input('type');
            $product->quantity = $request->input('quantity');
            $product->category = $request->input('category');
            $product->unit_price = $request->input('unitprice');
            $product->total_price = $request->input('totalprice');
            $product->description = $request->input('description');
            
            $product->save();
    
            return response()->json(['message'=>'ITEM SAVED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            \Log::info($e);
            return response()->json(['error' => 'Database Error: Conduct the system developer for help!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    

    }


    public function getProducts(){
        //to item table with categories and suppliersb based on foreign key and primary key
      //  $items=items::with('categories','suppliers','department')->get();
        $products=products::latest()->get();
        //$user = categories::find(1); 
        
        return response()->json(['data'=>$products]);

    }

    public function updateProduct(Request $request, $id)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
                'color' => 'required|max:30',
                'size' => 'required|max:30',
                'gender' => 'required|max:30',
                'quantity' => 'required|max:20',
                'category'=>'required',
                'unitprice'=>'required|numeric',
                'description'=>'required|string|max:255',

               // 'price' => 'required',
               // 'description' => 'required|numeric|digits:10',
               // 'email' => 'required|string|max:255',
              
            ]); 
            $product=products::find($id);
            // $item = new items();
            $product->name = $request->input('name');
            $product->color = $request->input('color');
            $product->size = $request->input('size');
            $product->gender = $request->input('gender');
            $product->type = $request->input('type');
            $product->quantity = $request->input('quantity');
            $product->category = $request->input('category');
            $product->unit_price = $request->input('unitprice');
            $product->total_price = $request->input('totalprice');
            $product->description = $request->input('description');

             $product->save();
            
            return response()->json(['message'=>'ITEM UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        

    }


    public function deleteProduct($id)
    {
        
        try {

           
             $product = products::find($id);
             //to delete categories with its related items
            
             $product->delete();
            
            return response()->json(['message'=>'ITEM DELETED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact sytem admin!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }



     public function addCategory(Request $request)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
               // 'item_no' => 'required|max:30',
              
            ]); 
            //$item=items::find($id);
             $category = new categories();
             $category->name = $request->input('name');
             $category->description = $request->input('description');
             $category->save();
            
            return response()->json(['message'=>'CATEGORY UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }


    public function getCategories(){
        $categories=categories::all();
        return response()->json(['data'=>$categories]);
    }



    public function updateCategory(Request $request, $id)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
               // 'item_no' => 'required|max:30',
               
              
            ]); 
            //$item=items::find($id);
             $category = categories::find($id);
             $category->name = $request->input('name');
             $category->description = $request->input('description');
             $category->save();
            
            return response()->json(['message'=>'CATEGORY UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Try again!It seems item same item type is already enterd in the system !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }


    public function deleteCategory($id)
    {
        
        try {

           
            //$item=items::find($id);
            //$category = categories::findOrFail($id);
             $category = categories::find($id);
             //to delete categories with its related items
             $relatedItemsCount = $category->items->count();

           // if ($category->items()->exists() ) {
                if ($relatedItemsCount>0 ) {
                // The category has related items
                return response()->json(['message' => 'Warning! This Category has related items and cannot be deleted.'], 422);

            }else{
             $category->delete();
            
            return response()->json(['message'=>'CATEGORY DELETED SUCCESSFULLY'],200);}
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact sytem admin !!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }


  

    public function addDepartment(Request $request)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
              
         
            ]); 
            //$item=items::find($id);
             $department = new department();
             $department->name = $request->input('name');
             $department->description = $request->input('description');
             $department->save();
            
            return response()->json(['message'=>'DEPARTMENT ADDED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact adminstrator!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
     

    }


    public function getDepartments(){

        $departments=department::all();

        return response()->json(['data'=>$departments],200);
    }


    public function updateDepartment(Request $request,$id)
    {
        
        try {

            $request->validate([
                'name' => 'required|string|max:30',
              
         
            ]); 
            $department=department::find($id);
             //$department = new department();
             $department->name = $request->input('name');
             $department->description = $request->input('description');
             $department->save();
            
            return response()->json(['message'=>'DEPARTMENT UPDATED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact adminstrator for help!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
     

    }

    public function deleteDepartment($id)
    {
        
        try {

           
             $dept = department::find($id);
             //to delete categories with its related items
            
             $dept->delete();
            
            return response()->json(['message'=>'DEPT DELETED SUCCESSFULLY'],200);
            
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database Error:Contact sytem admin!!'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        
    }


    
public function getSales(){
  //  $sales=sales::all();
    $sales=sales::with('products')->latest()->get();

    return response()->json(['data'=>$sales]);
}
  

public function saleProduct(Request $request)
{
    

    try {

        $request->validate([
           'quantity' => 'required|numeric|max:50',
           'unitprice' => 'required|numeric',
           'totalprice' => 'required|numeric',
           'productId'=>'required|numeric'
          
          
        ]); 
     //  dd( $request->input('staffID'));

        //$item=items::find($id);
         $sale = new sales();
         $sale->quantity = $request->input('quantity');
         $sale->unit_price= $request->input('unitprice');
         $sale->product_id= $request->input('productId');
         $sale->total_price=$request->input('totalprice');

         $product = products::where('id', $request->input('productId'))->first();
          $product->remain_quantity=$product->quantity - $request->input('quantity');
        
          $sale->save();
          $product->save();


        
        
        return response()->json(['message'=>'issue items ADDED SUCCESSFULLY'],200);
        
    } catch (QueryException $e) {

      //  \Log::info($e);
        return response()->json(['error' => 'Database Error:Contact adminstrator!!'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
 

}  
public function updateSales(Request $request,$id)
{
    

    try {

        $request->validate([
           'quantity' => 'required|numeric|max:30',
           'unitprice' => 'required|numeric|max:30',
           'totalprice' => 'required|numeric|max:130',
           'productId'=>'required|numeric'
          
          
        ]); 
     //  dd( $request->input('staffID'));

        //$item=items::find($id);
         $sale = sales::find($id);
         $sale->quantity = $request->input('quantity');
         $sale->unitprice= $request->input('unitprice');
         $sale->totalprice=$request->input('totalprice');
     
         $sale->save();
        
        return response()->json(['message'=>'issue items ADDED SUCCESSFULLY'],200);
        
    } catch (QueryException $e) {

      //  \Log::info($e);
        return response()->json(['error' => 'Database Error:Contact adminstrator!!'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
 

}  

public function deleteSales($id){
    $sales=sales::find($id);
   
    $sales->delete();
    return response()->json(['message'=>'sales deleted']);
   
   }


   public function getDailySales(){
    //  $sales=sales::all();

    $today=Carbon::today();
    //$sales=sales::with('products')->latest()->get();
    $salesReport = sales::with('products')
    ->whereDate('created_at', $today)
    ->get();
  
      return response()->json(['data'=>$salesReport]);
  }


  public function getMonthlySales() {
    $currentMonth = Carbon::now()->month;

    $salesReport = sales::with('products')
        ->whereMonth('created_at', $currentMonth)
        ->get();

    return response()->json(['data' => $salesReport]);
}


public function getWeeklySales() {
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    $salesReport = sales::with('products')
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->get();

    return response()->json(['data' => $salesReport]);
}




}
