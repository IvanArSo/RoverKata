<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/style.css')}}">      
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="bg-dark" >
        <div id="app" class="container">
            <div class="row bg-light border rounded m-3 shadow-lg">
                <div class="col-md-5 m-3 h-100">
                    <form @submit.prevent="handleSubmit" class="form-group">
                        <h4>Controles</h4>
                        <input type="text" name="command" id="command" class="form-control" v-model="command">
                        <div id="emailHelp" class="form-text">Introduce una secuencia de movimiento usando las letras <br> F (Forward) R (Right) L (Left)</div>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-block btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 m-3 h-100">
                    <h4>Resultado</h4>
                    <div class="border shadow-lg w-100" style="height: 200px">
                        <p id="message" class="m-1"></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const app = Vue.createApp({
            props: [
                'rover'
            ],
              data() {
                return {
                    command: '',
                    message: '',
                }
              },
              methods: {
                handleSubmit(values){
                    axios.post('http://127.0.0.1:8000/rover/movement',{command: values.target.elements.command.value})
                    .then(function(response){
                       document.getElementById('message').innerHTML = response.data;
                    })
                    .catch(error => {
                        if (!error.response) {
                            // network error
                            this.errorStatus = 'Error: Network Error';
                        } else {
                            this.errorStatus = error.response.data.message;
                            console.log(this.errorStatus)
                        }
                    })
                }
              }
            })
            app.mount('#app')
        </script>
    </body>
</html>
