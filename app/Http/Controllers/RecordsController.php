<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class RecordsController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        
        $renspa = $request->renspaRegistro;

        $record = Record::find($id);

        $record->delete();

        return redirect("/brutur/updateStatus/$renspa")->with('eliminarRegistro','ok'); 
    
    }
    
}
