<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Clientes::all();
            //return view('clientes.inicio');
            return view('clientes.inicio')->with('clientes',$clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                    'email' => 'required|email|unique:clientes',
                    'telefono' => 'required|string|max:255',
                    'direccion' => 'required|string|max:255',
                    'ciudad' => 'required|string|max:255',
                    'pais' => 'required|string|max:255',
                    
                    
                    
                ]);
        
                       
                // Crea un nuevo cliente con los datos validados
                //Clientes::create($validatedData);
        
                // Redirige a la página de listado de clientes u otra página de tu elección
                //return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito.');

                $result = Clientes::create($validatedData);

                if ($result) {
                    return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito0.');
                } else {
                   // return redirect()->route('clientes.index')->with('error', 'Cliente creado con éxito0.');
                    return redirect()->back()->withErrors('No se pudo crear el cliente. Por favor, verifica los datos.')->withInput();
                }
                
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // Encuentra la persona por su ID
         $cliente = Clientes::find($id);

         // Verifica si la persona existe
         if ($cliente) {
             // Elimina la persona
            $cliente->delete();
 
             // Retorna una respuesta de éxito
            return response()->json(['message' => 'Persona eliminada con éxito']);
         }
 
         // Retorna una respuesta de error si la persona no existe
            return response()->json(['error' => 'No se pudo encontrar la persona'], 404);
     
    }
}
