<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo App - @yield('title') </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="">
@section('header')
    <nav class="navbar navbar-expand-lg bg-body-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Todo App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-todo">All Todo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/add-todo">Add Todo</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@show

<div class="container-fluid " id="main-content">
    @yield('main-content')
</div>



@section('footer')
 <div class="container-fluid bg-secondary text-white p-3 text-center">
     <p>Designed by Kpodji Emmanuel Kwasi &copy;{{date('Y')}}</p>
 </div>
@show




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    //handle delete todo
    function deleteTodo(id){
        let confirmAction = confirm('Are you sure you want to delete this Item?')
        let urlChecker = checkCurrentUrl('/view-todo/');
        if(confirmAction){
            axios.post(`/delete-todo/${id}`)
                .then(function (res) {
                    alert(res.data?.message)
                    if(urlChecker){
                       window.location.href ="/"
                    }
                    else{
                        window.location.reload()
                    }
                })
                .catch((e) =>{
                    alert(res.data?.error)
                });
        }

    }

    // handle complete todo
    function completeTodo(item){
       let data ={
           name: item.name,
           status: 'completed',
           changed: true
       }
        console.log('item',data)
        let confirmActionconfirmAction = confirm('Are you sure you want to mark this Item as completed?')
        if(confirmActionconfirmAction){
            axios.post(`/edit-todo/${item.id}`,data)
                .then(function (res) {
                    alert(res.data?.message)
                    window.location.reload()
                })
                .catch((e) =>{
                    alert(res.data?.error)
                });
        }

    }

    // handle set todo as pending
    function setTodoPending(item){
        console.log(item)
        let data ={
            name: item.name,
            status: 'pending',
            changed: true
        }
        console.log('item',data)
        let confirmAction = confirm('Are you sure you want to mark this Item as Pending?')
        if(confirmAction){
            axios.post(`/edit-todo/${item.id}`,data)
                .then(function (res) {
                    alert(res.data?.message)
                    window.location.reload()
                })
                .catch((e) =>{
                    alert(res.data?.error)
                });
        }

    }

    //handle filtering

  // url checker
    function checkCurrentUrl(url){
        let currentUrl = window.location.href;
        return currentUrl.indexOf(url) !== -1;
    }


</script>
<style>
    #main-content{
        min-height: 100vh;
    }
</style>
</body>
</html>
