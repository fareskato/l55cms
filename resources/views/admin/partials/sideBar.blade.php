<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search for post or page...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="{{route('admin')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Media</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Images</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Files</a></li>
                </ul>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Posts</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('admin.post.create')}}"><i class="fa fa-circle-o"></i> New post</a></li>
                    <li><a href="{{route('admin.post.index')}}"><i class="fa fa-circle-o"></i> All posts</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Comments</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.tag.index')}}">
                    <i class="fa fa-tags"></i> <span>Tags</span>
                </a>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Categories</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.category.index')}}"><i class="fa fa-circle-o"></i> All categories</a></li>
                    <li class="active"><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i> New category</a></li>
                </ul>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Content</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Page</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Menu</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Widgets</a></li>
                </ul>
            </li>
            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Settings</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Config</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>