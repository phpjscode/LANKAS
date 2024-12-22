<!DOCTYPE html>
<html lang="en">

    <head>
        <x-head :title="$title"></x-head>
    </head>


    <body>
        <x-side-bar></x-side-bar>

        @yield('page')

        <x-footer></x-footer>
        <x-end-body></x-end-body>
    </body>

</html>
