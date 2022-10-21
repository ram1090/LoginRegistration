<div style="width:250px;" class="offcanvas offcanvas-start bg-white" tabindex="-1" data-bs-scroll="true"
    data-bs-backdrop="false" id="sideBar" aria-labelledby="sidebar_label">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-uppercase" id="sidebar_label">User Dashboard</h5>
        <button type="button" class="btn-close d-block d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#blog" role="button">
                    <span>Blog</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </a>
                <div class="collapse collapse-menu" id="blog">
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="">New Blog</a></li>
                        <li><a href="">Blog List</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>