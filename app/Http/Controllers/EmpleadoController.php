<?php
namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoPost;
use App\Models\Cargo;
use App\Repositories\EmpleadoRepo;

class EmpleadoController extends Controller
{  

    public function __construct()
    {
    
}

    //index
    public function listarEmpleados(Request $request)
    {
      if($request){
       $query = trim($request->get('datos'));
        $empleado = Empleados::where('nombre', 'LIKE', '%' .$query. '%')->paginate(2);
        return view('empleado.listar', compact('empleado'));
            }
  //  return view('empleado.listar', compact('empleado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargo = Cargo::all();
        return view('empleado.agregar', compact('cargo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // store
    public function agregarEmpleado(EmpleadoPost $validar){
    Empleados::create($validar->validated());

return redirect()->route('empleado.index')->with('guardar', 'Se ha Agregado Correctamente');
       /*
        return $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email', 
            'cargo' => 'required']);
       */
       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // show
    public function buscarEmpleado($id)
    {
    $empleado = Empleados::find($id);

    return view('empleado.detalle', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarEmpleado($id)
    {
        $empleado = Empleados::find($id);
        $cargo    = Cargo::all();

        return view('empleado.editar', compact('empleado', 'cargo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarEmpleado(EmpleadoPost $request, $id)
    {
        $empleado = Empleados::find($id);
        $empleado->update($request->validated());

        return redirect()->route('empleado.index')->with('modificar', 'Se ha Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    public function eliminarEmpleado($id)
    {
        $empleado = Empleados::find($id);
        $empleado->delete();
        return redirect()->route('empleado.index')->with('eliminar', 'Se ha Eliminado Correctamente');
    }
}