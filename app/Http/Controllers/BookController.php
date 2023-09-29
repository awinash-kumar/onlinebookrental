<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
      public function index(Request $request){
      $search = $request->search ?? "";

        if($search !=''){
          $book = Book::where(function ($query) use ($search) {
            $query->where('author', 'LIKE', "%$search%")
                  ->orWhere('title', 'LIKE', "%$search%");
        })->where('delete_status', 0)->paginate(10);
        }
        else{ 
          $book = Book::where('delete_status',0)->orderBy('id','DESC')->paginate(10);

        }
      return view('book_list')->with(compact('book'));
      }

      public function create(){
        return view('add_book');
      }
      
      public function store(Request $request){
              $validation =  validator::make($request->all(),[
                'title'=>'required | regex:/^[\pL\s\-]+$/u',
                'author'=>'required | regex:/^[\pL\s\-]+$/u',
                'description'=>'required',
                'market_price'=>'required | numeric |min:1',
              ]);
    
              if($validation->passes()){
                  $book = new Book();
                  $book->title = $request['title'];
                  $book->author = $request['author'];
                  $book->description = $request['description'];
                  $book->market_price = $request['market_price'];
                  $book->delete_status = 0;
                  $book->save();
                   if ($request->hasFile('images')) {
                        $image = $request->file('images');
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/books'), $imageName);
                        // Save the image path in the database
                        $book->images = $imageName;
                        $book->save();
    
            }
            return to_route('book.index')->with('success', 'Book insert successfully!');
    
              }else{
               return to_route('book.create')->withErrors($validation)->withInput();
              }
          }

          public  function edit($id){
            $book = Book::find($id);
            if($book !=''){
                $data = compact('book');
                return view('bookupdate')->with($data); 
            }else{
                return to_route('book.edit');
            }
          }

          public function update($id, Request $request){

            $validation =  validator::make($request->all(),[
              'title'=>'required | regex:/^[\pL\s\-]+$/u',
              'author'=>'required | regex:/^[\pL\s\-]+$/u',
              'description'=>'required ',
              'market_price'=>'required | numeric |min:1',
              ]);
    
              if($validation->passes()){
                  $book = Book::find($id);
                  $book->title = $request['title'];
                  $book->author = $request['author'];
                  $book->description = $request['description'];
                  $book->market_price = $request['market_price'];
                  $book->delete_status = 0;
                  $book->save();
                   if ($request->hasFile('images')) {
                    $oldImg = $book->images;
                        $image = $request->file('images');
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/books'), $imageName);   
                        // Save the image path in the database
                        $book->images = $imageName;
                        $book->save();
                        File::delete(public_path('uploads/books/' .$oldImg));
    
            }
              return to_route('book.index')->with('success', 'Update successfully!');
    
              }else{
               return to_route('book.edit', $id)->withErrors($validation)->withInput();
              }
          }

          public function delete($id){
            $book = Book::find($id);
            if($book!=''){
                File::delete(public_path('uploads/book/' .$book->images));
                Book::where('id', $id)->update(['delete_status' => 1]);
                // $book->delete();
                return to_route('book.index')->with('success', 'Deleted successfully!');
            }
          }
    
          public function show($id){
            $book = Book::find($id);
            return view('viewbook',compact('book'));
          }

          public function getBookDetails($id)
          {
              $book = Book::find($id);
              $book->cover_image_url = asset('uploads/books/' . $book->images);
              return response()->json($book);
          }
       
}