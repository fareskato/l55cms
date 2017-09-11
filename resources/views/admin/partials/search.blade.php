<div class="col-md-6">
    <div class="col-lg-8 col-lg-offset-2">
        <h2>
            <form method="GET" action="{{isset($search_route) ? $search_route : ''}}" role="search">
                <div class="input-group">
                    <input type="text" placeholder="search" name="s" class="form-control" required>
                    <span class="input-group-btn">
            <button type="submit" class="btn btn-flat">
            <i class="fa fa-search"></i>
            </button>
            </span>
                </div>
            </form>
        </h2>

    </div>
</div>