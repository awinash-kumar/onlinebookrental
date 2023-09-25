<style>
.border-left {
    border-left: 2px solid var(--primary) !important;
}

.sidebar {
    top: 0;
    left: 0;
    z-index: 100;
    overflow-y: auto;
}

.overlay {
    background-color: rgb(0 0 0 / 45%);
    z-index: 99;
}

.form-wrap {
    background: rgba(255, 255, 255, 1);
    width: 100%;
    max-width: 850px;
    padding: 50px;
    margin: 0 auto;
    position: relative;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
}

.form-group {
    margin-bottom: 25px;
}

.form-group>label {
    display: block;
    font-size: 16px;
    color: #837d7d;
    margin-bottom: 8px;
    font-weight: 800;
}

.custom-control-label {
    color: #000;
    font-size: 16px;
}

.form-control {
    height: 50px;
    background: #ecf0f4;
    border-color: transparent;
    padding: 0 15px;
    font-size: 16px;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #00bcd9;
    -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
}

textarea.form-control {
    height: 160px;
    padding-top: 15px;
    resize: none;
}

/* sidebar for small screens */
@media screen and (max-width: 767px) {
    .sidebar {
        max-width: 18rem;
        transform: translateX(-100%);
        transition: transform 0.4s ease-out;
    }

    .sidebar.active {
        transform: translateX(0);
    }
}
</style>
<x-app-layout>
    <!-- overlay -->
    <div id="sidebar-overlay" class="overlay w-100 vh-100 position-fixed d-none"></div>
    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
        <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>
        <div class="list-group rounded-0" style="padding-top:70px;">
            <a href="{{route('dashboard')}}"
                class="list-group-item  sidebar-item list-group-item-action border-0 d-flex align-items-center">
                <span class="bi bi-border-all"></span>
                <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{route('custmer.index')}}"
                class="list-group-item  list-group-item-action border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">User List</span>
            </a>
            <a href="{{route('book.index')}}"
                class="list-group-item list-group-item-action active border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">Book List</span>
            </a>
            <a href="{{route('order.index')}}"
                class="list-group-item list-group-item-action  border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">Order List</span>
            </a>
        </div>
    </div>
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        <!-- main content -->
        <main class="p-4 min-vh-100" style="padding-top:40px!important;">
            <div class="container">
                <div class="form-wrap" style="background-color: #d1e7dd;">
                    <h2 style="text-align: center; font-size: 24px;font-weight: 700;padding-bottom: 33px;">Book Detail
                    </h2>
                    <form id="survey-form" action="{{ route('custmer.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="name">Title</label>
                                    <span>{{$book->title}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="author-label" for="email">Author</label>
                                    <span>{{$book->author}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="number-label" for="number">Market Price</label>
                                    <span>{{$book->market_price}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span>{{$book->description}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Cover Page</label>
                                @if($book->images !='')
                                <img src="{{ url('uploads/books/'.$book->images ) }}" alt="" width="100" height="100"
                                    class="rounded-circle">
                                @else
                                <img src="{{url('uploads/books/book.avif')}}" alt="" width="100" height="100">
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
<script>
$(document).ready(function() {
    $(".sidebar-item").click(function() {
        // Remove 'active' class from all sidebar items
        $(".sidebar-item").removeClass("active");
        // Add 'active' class to the clicked sidebar item
        $(this).addClass("active");
    });
});
</script>