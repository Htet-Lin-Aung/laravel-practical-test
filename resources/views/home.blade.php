@extends('layouts.app')

@section('content')

@if ($notification = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $notification }}</strong>
</div>
@endif


@if ($notification = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $notification }}</strong>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach($forms as $form)
                <div class="card-header">{{ $form->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('survey') }}">
                        @method('POST')
                        @csrf
                        @foreach($form->fields as $field)
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="{{$field->name}}" class="col-form-label text-md-end">{{ $field->name }}</label>
                            </div>
                            <input type="hidden" name="form_id" value="{{$form->id}}">

                            <div class="col-md-12">
                                @if($field->type == "textarea")
                                <textarea id="{{$field->code}}" class="form-control @error('{{$field->code}}') is-invalid @enderror" name="{{$field->code}}">{{ old($field->code) }}</textarea>
                                @else
                                <input id="{{$field->code}}" type="{{$field->type}}" class="form-control @error('{{$field->code}}') is-invalid @enderror" name="{{$field->code}}" value="{{ old($field->code) }}" required autofocus>
                                @endif

                                @error('{{$field->code}}')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $('input[type="datepicker"]').datepicker({
            format: "yyyy-mm-dd"
        });
    </script>
@endsection
