@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-sm-12 col-md-12 mx-auto">
    <file-uploud></file-uploud>

    <table class="table overflow">
        <thead>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{$file->name}}</td>
                
                    <td class="d-flex">
                        <form class="ml-auto" action="{{route('a_delete_file',$file->id)}}" method="POST">
                            <button type="submit" class="btn btn-danger mx-1">
                                <i class="fa fa-trash"></i>
                            </button>
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection

