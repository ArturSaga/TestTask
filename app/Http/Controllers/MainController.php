<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Author;
use App\Models\Book;


class MainController extends Controller
{
    public function getName()
    {
        $name = Book::with('getAuthors')
       		->get(['id','name'])
       		->toArray();
        $authors = Author::with('getBooks')
       		->get(['id','full_name'])
       		->toArray();
       	$anonim = Book::whereDoesntHave('getAuthors')
       		->get()
       		->pluck('name')
       		->toArray();

        return view('home', [
	       	'data' => $authors,
	       	'list' => $name,
	       	'page' => $anonim
        ]);
    }

    public function getResult(Request $request)
    {
    	 $id = $request->get('id');
    	 $type = $request->get('type');
    	 switch ($type) {
    	 	case 'books':
         		$result = Book::find($id)
         			->getAuthors
         			->pluck('full_name')
         			->toArray();
    	 		break;
    	 	case 'authors':
    	 		$result = Author::where('id', $id)
	     			->withSum('getBooks', 'price')
	     			->get()
	     			->pluck('get_books_sum_price')
	     			->toArray();
    	 		break;
    	 }
    	 return json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}

