<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\author\AuthorModel;

class AuthorController extends Controller
{
    private $authorModel;
    public function __construct(){
        $this->authorModel = new AuthorModel();
    }

        
    /**
     * author
     * This is used to load the xml file. Add the authors and books data into the respective tables.
     * @param  mixed $arrParameters
     * @return array
     * PrasanthK
     */
    public function author(Request $arrParameters){
        $validation = Validator::make($arrParameters->all(),[
            'file' => 'required|mimes:xml|max:2048'
        ]);

        if($validation->fails()){
            return response('Please send the valid file', 400);
        }
        $strFileName = $fileName = 'sample.'.$arrParameters->file->extension();
        $arrParameters->file->move(public_path('uploads'), $strFileName);
        $xmlString = file_get_contents(public_path('uploads/'.$fileName));
        $xmlObject = simplexml_load_string($xmlString);
        $arrData = json_decode(json_encode($xmlObject),true)['book'];
        
        $blnResult = $this->authorModel->insertAuthor($arrData);
        if($blnResult){
            $arrResponse['code'] = 1;
            $arrResponse['description'] = 'Success';
        }
        else{
            $arrResponse['code'] = -1;
            $arrResponse['description'] = 'Fail';
        }
        return $arrResponse;
    }
}
