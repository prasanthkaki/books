<?php

namespace App\Http\Controllers\books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\books\BooksModel;

class BooksController extends Controller
{
    private $booksModel;

    public function __construct(){
        $this->booksModel = new BooksModel();
    }

    public function books(Request $arrParameters){
        $strAuthorName = $arrParameters['author_name'];
        $arrResult = $this->booksModel->books($strAuthorName);
        return view('welcome')->with('details',$arrResult);
        // $arrResponse['data'] = $arrResult;
        // return $arrResponse;
    }
}
