<div
    class="top-menubar d-flex justify-content-between align-items-center bg-white shadow-sm px-3 py-2 fixed-top flex-column flex-sm-row" style="width:calc(100% - 250px);left:inherit;right:0;transition:all 350ms">
    <div class="d-flex align-items-center justify-content-between">
        <button class="btn rounded-full btn-light me-5 me-md-2" style="border-radius : 50%;" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#sideBar" aria-controls="sideBar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <form action="#">
            <div class="input-group">
                <input type="search" placeholder="Search here..." name="keyword" id="keyword"
                    class="form-control rounded-0">
                <button type="submit" class="btn btn-danger rounded-0">Search</button>
            </div>
        </form>
    </div>
    <ul class="nav justify-content-end mt-2 mt-md-0">
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-comment"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-bell"></i></a>
        </li>
        <li class="nav-item">
            <div class="dropdown" >
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                </button>
                <ul class="dropdown-menu border-0 shadow-sm">
                    <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Change password</a></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>