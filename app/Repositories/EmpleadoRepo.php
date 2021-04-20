<?php
namespace App\Repositories;

use App\Models\Cargo;
use App\Models\Empleados;
use Illuminate\Http\Request;

class EmpleadoRepo{
    public function findAllEmpleados(Request $request){
      
            $query = trim($request->get('datos'));

            $empleado = Empleados::where('nombre', 'LIKE', '%' .$query. '%')->orderBy('id', 'asc')->paginate(2);
            return $empleado;
           
        
    }
    public function findAllCargos(){
        $cargo = Cargo::all();
        return $cargo;
    }

    public function cambioestado($id, $estado){
        $empleado = Empleados::find($id);
        $empleado->update(['estado'=> $estado]);
        return $empleado;
    }
}
