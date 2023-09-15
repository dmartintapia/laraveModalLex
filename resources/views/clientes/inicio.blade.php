@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2',true)

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')

    <button type="button" class="btn btn-primary mb-3"data-bs-toggle="modal" data-bs-target="#myModal-lg"><i class='fa fa-plus'></i></button>

<!-- Modal Crear-->
    <div class="modal fade" id="myModal-lg" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="myModal-lg">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{route('clientes.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Telefono:</label>
                                        <input type="text" id="telefono" name="telefono" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" id="direccion" name="direccion" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad:</label>
                                        <input type="text" id="ciudad" name="ciudad" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pais">Pais:</label>
                                        <input type="text" id="pais" name="pais" class="form-control">
                                    </div>
                                                                        
                                
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>        


                </div>
           
            </div>
        </div>
    </div>
<!-- Modal -->


    <div class="card">
     <div class="card-body">
   <?php 
   
   ?>

        <table id="tabla-personas" class="table">
            <thead>
                <tr>
                
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Direccion</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Pais</th>
                
                
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                
                 @foreach ($clientes as $cliente)
                <tr id="row-{{$cliente->id}}">
                    <th scope="row">{{$cliente->id}}</th>
                    
                        <td  style="vertical-align: middle;">{{$cliente->nombre}}</td>
                        <td  style="vertical-align: middle;">{{$cliente->email}}</td>
                        <td  style="vertical-align: middle;">{{$cliente->telefono}}</td>
                        <td  style="vertical-align: middle;">{{$cliente->direccion}}</td>
                        <td  style="vertical-align: middle;">{{$cliente->ciudad}}</td>
                        <td  style="vertical-align: middle;">{{$cliente->pais}}</td>
                    
                    
                    <td>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit{{$cliente->id}}" role="button"><i class='fa fa-edit'></i></a>

                        <a href="#" class="btn btn-danger delete-person" data-id="{{ $cliente->id }}" role="button">
                            <i class='fa fa-trash'></i>
                        </a>
                    </td>
                    <!-- Modal Editar-->
<div class="modal fade" id="modalEdit{{$cliente->id}}" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEdit">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" id="nombre" value="{{$cliente->nombre}}"name="nombre" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido:</label>
                                        <input type="text" id="apellido" value="{{$cliente->apellido}}"name="apellido" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" id="direccion" value="{{$cliente->direccion}}"name="direccion" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" value="{{$cliente->email}}"name="email" class="form-control">
                                    </div>
                                
                                    <div class="form-group">
                                    <label for="photo">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    
                                
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                            <div class="col-md-6  d-flex align-items-center justify-content-center">
                                    <div class="form-group">
                                        <img id="imagePreview" src="{{ asset('storage').'/'.$cliente->foto }}" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 0, 0, 1.2);">
                                    </div>
                            </div>
                        </div>
                    </div>        


                </div>
           
            </div>
        </div>
    </div>
<!-- Modal -->
                </tr>  
                 @endforeach   
                              
            </tbody>
        </table>
        </div>
    </div>    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

@stop



@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
        
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>     
    <script>
        $(document).ready(function() {
            $('.delete-person').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                //if (confirm('¿Estás seguro de que deseas eliminar esta persona?')) {
                    //alertify.confirm('¿Estás seguro de que deseas eliminar esta persona?', function(){

                        Swal.fire({
                        title: '¿Estás seguro de que deseas eliminar?',
                        //showDenyButton: true,
                        //showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        }).then((result) => {
                        
                            $.ajax({
                                url: '/clientes/' + id,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {

                                    //alert("se elimino registro");
                                    //location.reload(true)
                                    //cargarTabla();
                                    // La solicitud de eliminación se ha completado con éxito
                                    // Aquí puedes realizar acciones adicionales, como actualizar la lista de personas o mostrar un mensaje de éxito.
                                    $('#row-' + id).remove();

                                    // O si quieres mostrar un mensaje de éxito utilizando Alertify.js:
                                    //alertify.success(response.message);
                                    },

                                error: function(xhr, status, error) {
                                    // Se produjo un error durante la solicitud de eliminación
                                    // Aquí puedes mostrar un mensaje de error o realizar acciones adicionales según sea necesario.
                                }
                                });
                            });
            });
        });
    </script>

    @if(session('success'))
    <!--<div class="alert alert-success">
        {{ session('success') }}
    </div>-->
    
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
    @endif

    @if($errors->any())
    <!--<div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>-->
    <script>
        alert('error al crear')
    </script>
    @endif

@stop
