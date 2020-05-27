<script>
    window.routes = @json(collect(\Route::getRoutes())->mapWithKeys(function ($route) { return [$route->getName() => $route->uri()]; }))
</script>
