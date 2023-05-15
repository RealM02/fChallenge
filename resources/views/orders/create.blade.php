@extends('layouts.app')

@section('content')
    <h1>Create Order</h1>
    <!-- Order creation form -->
    <div class="form-group">
        <label for="delivered_image">Delivered Image</label>
        <input type="file" name="delivered_image" id="delivered_image" class="form-control-file">
    </div>
@endsection