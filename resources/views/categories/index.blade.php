@extends('master')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">category_name</th>
        <th scope="col">actions</th>

      </tr>
    </thead>
    <tbody>
        {{--  @foreach ($collection as $item) --}}
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            
          </tr>
            
      {{--   @endforeach --}}
     
    
    </tbody>
  </table>
@endsection
