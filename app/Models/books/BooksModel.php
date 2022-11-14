<?php

namespace App\Models\books;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BooksModel extends Model{
    protected $table = 'books';
    public $timestamps = false;
    
    /**
     * insertBooks
     * This is used to update or insert the books.
     * @param  array $arrData
     * @return int
     */
    public function insertBooks(array $arrData){
        try{
            return BooksModel::updateOrInsert(['name' => $arrData['book_name']],
                ['author_id' => $arrData['author_id'], 'modified_datetime' => now()]);
        }
        catch(QueryException $exception){
            LOG::error($exception->getMessage());
            return 0;
        }
    }

    public function books(string $authorName){
        try{
            return BooksModel::join('authors as a','a.id','books.author_id')
                ->where('a.name','like','%'.$authorName.'%')
                ->select('a.name as author_name','books.name as book_name')
                ->get();
        }
        catch(QueryException $exception){
            LOG::error($exception->getMessage());
        }
    }
}
