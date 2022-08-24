<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login component VUE</div>
                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="login($event)">

                            <input type="hidden" name="_token" :value="csrf_token">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Me mantenha conectado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        LOGIN
                                    </button>

                                    <a class="btn btn-link" href="">
                                        Esqueci minha senha
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    props: [
        'csrf_token'
    ],
    data(){
      return{
          email: '',
          password: ''
      }
    },
    methods:{
        login(e) {
            let url = 'http://localhost:8000/api/login'
            let configuracao = {
                method: 'post',
                body: new URLSearchParams( {
                    'email': this.email,
                    'password': this.password
                })
            }

            fetch(url, configuracao)
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        document.cookie = 'token='+data.token+';SameSite=Lax'
                        e.target.submit()
                    }
                })

        },
    }
}
</script>

<style scoped>

</style>
