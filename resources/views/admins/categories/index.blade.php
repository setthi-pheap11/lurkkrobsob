@extends('layouts.master')
@section('custom-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <!-- <a href="{{route('category.create')}}" class="btn btn-primary">Create</a> -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>List of category</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif

                <table class="table table-bordered datatable" id="dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@include('admins.categories.create')
@include('admins.categories.edit')
@endsection

@section('custom-js')
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            // datatable 
            var table = $('#dataTable').DataTable({
               pageLength: 5,
               processing: true,
               serverSide: true,
               scrollX: true,
               ajax: "{{ route('category.index') }}",
               columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
               ]
              
           });

            //save data
            $('#btn_save').click(function(){
                let token = $('input[name=_token]').val();
                let name = $('#category').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('category.save')}}",
                    data: {
                        'name': name, 
                        '_token': token
                    },
                    success: function (response) {
                        console.log(response);
                        if(response.status == 200){
                            $('#category').val('');
                            $('#createModal').modal('hide');
                            // $("#formSubmit")[0].reset();
                            $('#dataTable').DataTable().ajax.reload();
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
               });
            })

            //edit data
            // $('#btn_edit').click(function(){
                
        })

        function saveData(event){
            event.preventDefault();
            
            let token = $('input[name=_token]').val();
            let name = $('#ecategory').val();
            let id = $('#eid').val();
            $.ajax({
                type: "POST",
                url: "{{route('category.update')}}",
                data: {
                    'id': id, 
                    'name': name, 
                    '_token': token
                },
                success: function (response) {
                    console.log(response);
                    if(response.status == 200){
                        $('#category').val('');
                        $('#editModal').modal('hide');
                        // $("#formSubmit")[0].reset();
                        $('#dataTable').DataTable().ajax.reload();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
        function editRow(id, event){
            $.ajax({
                type: "get",
                url: "{{route('category.edit', '')}}/"+id,
                success: function (response) {
                    console.log(response);
                    if(response.status == 200){
                        $('#eid').val(response.data.id);
                        $('#ecategory').val(response.data.name);
                        $('#editModal').modal('show');
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }

        function removeRow(id, event){
            $.ajax({
                type: "get",
                url: "{{route('category.delete', '')}}/"+id,
                success: function (response) {
                    console.log(response);
                    if(response.status == 200){
                        $('#dataTable').DataTable().ajax.reload();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    </script>
@endsection