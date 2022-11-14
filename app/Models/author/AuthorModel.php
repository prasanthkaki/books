<?php

namespace App\Models\author;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\books\BooksModel;
use Illuminate\Support\Facades\Log;

class AuthorModel extends Model
{
    protected $table = 'authors';
    public $timestamps = false;
    private $booksModel;

    public function __construct(){
        $this->booksModel = new BooksModel();
    }
    
    /**
     * insertAuthor
     * This is used to update or insert the authors
     * @param  array $arrData
     * @return int
     * PrasanthK
     */
    public function insertAuthor(array $arrData){
        try{
            DB::beginTransaction();
            foreach($arrData as $arrResult){
                AuthorModel::updateOrInsert(['name' => $arrResult['author']]);
                $intAuthorId = DB::table('authors')->where(['name' => $arrResult['author']])
                    ->select('id')->pluck('id')->first();
                $arrBook['author_id'] = $intAuthorId;
                $arrBook['book_name'] = $arrResult['name'];
                $intResult = $this->booksModel->insertBooks($arrBook);
                if(!$intResult){
                    DB::rollBack();
                    return 0;
                }
            }
            DB::commit();
            return 1;
        }
        catch(QueryException $exception){
            DB::rollBack();
            LOG::error($exception->getMessage());
            return 0;
        }
    }
}
