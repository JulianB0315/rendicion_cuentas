<?php 

namespace App\Controllers;

class ConferenciaController extends BaseController
{
    public function show($id)
    {
        
        return view('conferencia', ['id' => $id]);
    }
}

?>