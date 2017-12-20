@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Gruppenbild
                </div>
                <div class="card-body">
                    @if(session()->has('info'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('info')}}
                        </div>
                    @endif
                    <form action="{{route('uploud_group_image')}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="custom-file" style="width: 100%;">
                                <input type="file" id="file" class="custom-file-input" name="file" required>
                                <span class="custom-file-control"> <i class="fa fa-upload"></i> Gruppenbild hochladen..</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-success">
                                <i class="fa fa-plus"></i> Aktualisieren
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>

                    <form action="{{route('remove_group_image')}}" method="post">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger form-control">
                                <i class="fa fa-trash"></i> Löschen
                            </button>
                        </div>
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Vorstand
                </div>
                <div class="card-body">
                    @if(session()->has('vorstand_image'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('vorstand_image')}}
                        </div>
                    @endif
                    <form action="{{route('uploud_vorstand_image')}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="custom-file" style="width: 100%;">
                                <input type="file" id="file" class="custom-file-input" name="file" required>
                                <span class="custom-file-control"> <i class="fa fa-upload"></i> Bild hochladen..</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-success">
                                <i class="fa fa-plus"></i> Aktualisieren
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>

                    <form action="{{route('remove_vorstand_image')}}" method="post">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger form-control">
                                <i class="fa fa-trash"></i> Löschen
                            </button>
                        </div>
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
