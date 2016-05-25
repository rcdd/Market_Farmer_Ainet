@extends('layouts.backend')

@section('title', 'Growing strong')

@section('content')


   <!-- SLIDESHOW -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                  <img src="{{ asset('assets/images/market1.jpg') }}" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
            </div>

            <div class="item">
                  <img src="{{ asset('assets/images/market2.jpg') }}" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
            </div>

            <div class="item">
                  <img src="{{ asset('assets/images/market3.jpg') }}" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
            </div>

            <div class="item">
                  <img src="{{ asset('assets/images/market4.jpg') }}" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
            </div>
        </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
    </div>

    <!-- END SLIDESHOW -->
<br />
<br />

        <div class="container-fluid">
            <div class="text">

Founded in 1994, Urban Harvest has garnered a well-deserved reputation as a leader in the local food movement. We've earned this role by adhering to clear and simple values and a focused mission:

Urban Harvest encourages community, good nutrition and sustainability through the teaching and support of organic gardening.

Under the direction of an all-volunteer board, Urban Harvest has grown from humble beginnings to employ a full-time staff and literally thousands of volunteers. Funding comes from nearly 1,500 annual memberships, and from individual and corporate donations, private foundations, and public grants.

            </div>
        </div>

@endsection
