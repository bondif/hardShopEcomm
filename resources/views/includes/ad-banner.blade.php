<div class="banner">
    <h2>
        <a href="/admin">Home</a>
        @foreach($pages as $page)
            <i class="fa fa-angle-right"></i>
            <span>{{ $page }}</span>
        @endforeach
    </h2>
</div>