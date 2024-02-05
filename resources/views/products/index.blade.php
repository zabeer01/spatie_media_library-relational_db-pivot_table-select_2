@extends('master')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">product_name</th>
                <th scope="col">product_description</th>
                <th scope="col">category</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            {{--  @foreach ($collection as $item) --}}
            @foreach ($products as $product)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>
                        {{--       {{ $product->categories }} // provides jadon format array --}}
                        @foreach ($product->categories as $category)
                            {{ $category->category_name }}
                        @endforeach
                    </td>
                    <td>edit</td>
                    <td>delete</td>
                </tr>
            @endforeach


            {{--   @endforeach --}}


        </tbody>
    </table>
@endsection
