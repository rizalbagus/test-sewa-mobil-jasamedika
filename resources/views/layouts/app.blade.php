<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Penyewaan Mobil') }}
                </a>
                @guest

                @else
                <a class="navbar-brand" href="{{ url('/m-cars') }}">
                    Mobil (Owned)
                </a>
                <a class="navbar-brand" href="{{ url('/t-car-loans') }}">
                    Peminjaman
                </a>
                <a class="navbar-brand" href="{{ url('/t-car-returns') }}">
                    Pengembalian
                </a>

                @endguest

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a id="name" class="nav-link active" href="{{ route('profile') }}" >
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<div class="modal fade" id="dataModal" aria-hidden="true" role="dialog">
    <div class="modal-dialog" id="your_modal_detail">

    </div>
</div>
<div class="modal fade" id="dataModalLarge" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg" id="your_modal_detail_large">

    </div>
</div>
@guest

@else

@yield('script')

<script type="text/javascript">
    function create() {  
        $.ajax({  
            url : "{{ route($route.'.create') }}", 
            type:"GET",   
            success:function(data){
            //alert(data);  
                $('#your_modal_detail').html(data);  
                $('#dataModal').modal("show"); 


            }  
        }); 
    }

    function createLarge() {  
        $.ajax({  
            url : "{{ route($route.'.create') }}", 
            type:"GET",   
            success:function(data){
            //alert(data);  
                $('#your_modal_detail_large').html(data);  
                $('#dataModalLarge').modal("show"); 


            }  
        }); 
    }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '#show-data', function () {
          var id = $(this).data('id');
          $.get('{{ url($route)."/" }}' + id + '/edit', function (data) {
             $('#your_modal_detail').html(data);  
             $('#dataModal').modal("show"); 


         })
      });

        $('body').on('click', '.delete', function () {

            var id = $(this).data("id");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "{{ url($route) }}"+'/'+id,
                success: function (data) {
                    alert("Deleted success");
                    window.location.replace("{{ url($route) }}");
                    console.log("it Works");
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endguest

</body>
</html>
