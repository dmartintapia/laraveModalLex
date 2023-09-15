<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $personas = Persona::all();
            //return view('persona.index',compact('datos'));
            return view('persona.inicio')->with('personas',$personas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validación de datos (puedes agregar más reglas de validación según tus necesidades)
         $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|unique:personas',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            
        ]);

        // Procesar la imagen si se ha cargado
        if ($request->hasFile('foto')) {
            //$image = $request->file('foto');
            //$imageName = time() . '.' . $image->getClientOriginalExtension();
            //$image->move(public_path('uploads'), $imageName); // Almacena la imagen en la carpeta 'uploads' (debes crearla)
            $validatedData['foto'] = $request->file('foto')->store('uploads','public'); // Almacena la ruta de la imagen en la base de datos
        }

        // Crea un nuevo cliente con los datos validados
        Persona::create($validatedData);

        // Redirige a la página de listado de clientes u otra página de tu elección
        return redirect()->route('persona.index')->with('success', 'Cliente creado con éxito.');
////
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosPersona = request()->except(['_token','_method']);
        if ($request->hasFile('foto')) {
          
            $datosPersona['foto'] = $request->file('foto')->store('uploads','public'); // Almacena la ruta de la imagen en la base de datos
        }

        Persona::where('id','=',$id)->update($datosPersona) ;
        return redirect()->route('persona.index')->with('success', 'Cliente creado con éxito..');
        //return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        //if (!$persona) {
        //    return response()->json(['error' => 'No se encontró la persona'], 404);
        //} 
    
        $persona->delete();
        return response()->json(['success' => 'Persona eliminada correctamente']);
    }
}
