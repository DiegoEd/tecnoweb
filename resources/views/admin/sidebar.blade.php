<div class="col-md-3">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Sidebar
        </div>

        <div class="panel-body">
            @if (empty(session('imagepath')))
            <img src="../../../img/users/default.jpg" height="100" width="100">
            @else
            <img src="../../../img/users/{{ session('imagepath') }}">
            @endif
        </div>
    </div>
</div>
