@extends('layouts.user')

@section('user')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('public/user') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">My salary</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>My salary <i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>
    <section>
        <div class="container">
            <div class="card-content">
        <h4 class="card-title">Simple Table</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Job Position</th>
                        <th>Since</th>
                        <th class="text-right">Salary</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Andrew Mike</td>
                        <td>Develop</td>
                        <td>2013</td>
                        <td class="text-right">€ 99,225</td>
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                                <i class="material-icons">person</i>
                            </button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
        </div>
      
    </section>
@endsection