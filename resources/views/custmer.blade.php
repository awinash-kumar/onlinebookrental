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

/* .icon_hov {
    border-radius: 10px;
    font-weight: bold;
    color: black;
    cursor: pointer;
}
.icon_hov:hover {
    background-color: #afdfc9;
} */
.fa_custom_pencil {
    color: #0099CC
}

.fa_custom_pencil:hover {
    color: #131516;
}

.fa_custom_delete {
    color: red;
}

.fa_custom_delete:hover {
    color: #131516;
}

.fa_custom_eye {
    color: #302a2a;
}

.fa_custom_eye:hover {
    color: grey;
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
                class="list-group-item  sidebar-item list-group-item-action  border-0 d-flex align-items-center">
                <span class="bi bi-border-all"></span>
                <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{route('custmer.index')}}"
                class="list-group-item list-group-item-action active border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">User List</span>
            </a>
            <a href="{{route('book.index')}}"
                class="list-group-item list-group-item-action  border-0 align-items-center sidebar-item">
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
            <h1 style="font-size: 27px;font-family: system-ui;">User List</h1>
            <a href="{{route('custmer.create')}}" class="btn btn-primary mb-2" style="float: right;">
                <span>Add</span>
            </a>
            @if(Session::has('success'))
            <p class="alert alert-info" style="margin-left: 442px; width:253px;">{{ Session::get('success') }}</p>
            @endif
            <form style="display:flex;gap:10px" action="" method="get">
                <input type="search" class="Search" name="search" value="" style="border:none"
                    placeholder="Search Here By name,email....." autocomplete="off">
                <button style="background: #0d6efd; color: white;" type="submit" class="btn">Search</button>
                <a class="btn btn-success " style=" margin-left: 0%; margin-top: 0%;"
                    href="{{route('custmer.index')}}">Reset</a>
            </form>
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
                    @if(!$custmor->isEmpty())
                    @foreach($custmor as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            <a href="{{route('custmer.edit',$user->id)}}"><i
                                    class="fa fa-pencil fa_custom_pencil"></i></a>
                            <a style="padding:0 10px"><i class="fa fa-trash fa_custom_delete"
                                    onclick="deleteUser({{$user->id}})"></i></a>
                            <a href="{{route('custmer.show',$user->id)}}"><i class="fa fa-eye fa_custom_eye"></i></a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @else
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span style=" font-size:30px"> {{'No Data Found!'}}</span></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
            </table>
            <div>
                {{$custmor->links()}}
            </div>
        </main>
    </div>
</x-app-layout>
<script>
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this Customer?')) {
        window.location.href = '/custmer/delete/' + userId;
    } else {}
}
</script>