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
                class="list-group-item  sidebar-item list-group-item-action active border-0 d-flex align-items-center">
                <span class="bi bi-border-all"></span>
                <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{route('custmer.index')}}"
                class="list-group-item list-group-item-action border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">User List</span>
            </a>
            <a href="{{route('book.index')}}"
                class="list-group-item list-group-item-action border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">Book List</span>
            </a>
            <a href="{{route('order.index')}}"
                class="list-group-item list-group-item-action border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">Order List</span>
            </a>
        
        </div>
    </div>
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
     
        <main class="p-4 min-vh-100" style="padding-top:40px!important;">
            @if(Session::has('success'))
            <p class="alert alert-info" style="margin-left: 442px; width:253px;">{{ Session::get('success') }}</p>
            @endif
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body"
                                style="background: #ffc107;color: black;font-size: 21px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;padding:23px">
                                <div class="">
                                    <div class="align-self-center">
                                        <i class="icon-pencil primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <a href="{{ route('custmer.index') }}">
                                            <h3>{{ $totalUsers }}</h3>
                                            <span>Total User</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body"
                                style="background: #6defb3;color: black;font-size: 21px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;padding:23px">
                                <div class="">
                                    <div class="align-self-center">
                                        <i class="icon-speech warning font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <a href="{{ route('book.index') }}">
                                            <h3>{{ $totalbook }}</h3>
                                            <span>Total Book</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body"
                                style="background: #86afeb;color: black;font-size: 21px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;padding:23px">
                                <div class="">
                                    <div class="align-self-center">
                                        <i class="icon-graph success font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <a href="{{ route('book.index') }}">
                                            <h3 data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Total Market Price / Rental Price">
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Total Market Price">{{ number_format($totalMarketPrice, 2)}}</span>
                                                / <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Total Rental Price">{{ number_format($totalrentalPrice, 2)}}</span>
                                            </h3>
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Total Market Price / Rental Price">Total <span
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Total Market Price">M.P</span> /
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Total Rental Price"> R.P</span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body"
                                style="background: #d76e9a;color: black;font-size: 21px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;padding:23px">
                                <div class="">
                                    <div class="align-self-center">
                                        <i class="icon-pointer danger font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$totalRentalbook}}</h3>
                                        <span>Total Issue Book</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class=" table table-success table-striped" style="margin-top:7px;background:white;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Address</th>
                        <th scope="col" style="width:110px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($custmor as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            <a href="{{route('custmer.edit',encrypt($user->id))}}"><i
                                    class="fa fa-pencil fa_custom_pencil"></i></a>
                            <a style="padding:0 10px"><i class="fa fa-trash fa_custom_delete"
                                    onclick="deleteUser( '{{encrypt($user->id)}}')"></i></a>
                            <a href="{{route('custmer.show',encrypt($user->id))}}"><i class="fa fa-eye fa_custom_eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$custmor->links()}}
            </div>
        </main>
    </div>
</x-app-layout>
<script>
$(document).ready(function() {
    $(".sidebar-item").click(function() {
        $(".sidebar-item").removeClass("active");
        $(this).addClass("active");
    });
});
</script>
<script>
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this Customer?')) {
        window.location.href = '/custmer/user_delete/' + userId;
    } else {}
}
</script>