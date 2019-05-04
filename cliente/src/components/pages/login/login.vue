<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" align="center" style="padding:50px;">
                <div>
                    <i class="fas fa-book-open"></i>
                    <form>
                        <small class="form-text text-muted" v-if="validation">
                            <span class="text-danger">{{data.email[0]}}</span>
                        </small>
                        <small class="form-text text-muted" v-if="validation_2">
                            <span class="text-danger">Email ou senha não existem</span>
                        </small>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" v-model="email">
                        </div>

                        <small class="form-text text-muted" v-if="validation">
                            <span class="text-danger">{{data.password[0]}}</span>
                        </small>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" v-model="password">
                        </div>

                        <button type="button" class="btn btn-primary btn-block" v-on:click="login()">Entrar</button>
                        
                        <small class="form-text text-muted">Esqueceu sua senha?</small>

                        <div class="form-group" style="margin:30px 10px;">
                            <span class="form-text float-left">
                                Não possui uma conta? 
                            </span>
                            <router-link to="/cadastro">
                                <button type="button" class="btn btn-outline-primary btn-sm float-right">Resgistrar</button>
                            </router-link>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: 'login',
        data() {
            return {
                email:'',
                password:'',
                validation:false,
                validation_2:false,
                data:'',
                usuario: false
            }
        },
        created(){

            let usuario = sessionStorage.getItem('usuario');

            if(usuario){

                this.usuario = JSON.parse(usuario);

                switch(this.usuario.tipo){

                    case 's':
                        this.$router.push('/adm/home');
                    break;
                    case 'a':
                        this.$router.push('/atendete/home');
                    break;
                    case 'b':
                        this.$router.push('/home');
                    break;

                }

            }

        },
        methods:{

            login(){
                axios.post(`http://localhost:8000/api/login`, {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    if(response.data.token){

                        sessionStorage.clear();
                        sessionStorage.setItem('usuario', JSON.stringify(response.data));
                        
                        switch(response.data.tipo){

                            case 's':
                                this.$router.push('/adm/home');
                            break;
                            case 'a':
                                this.$router.push('/atendete/home');
                            break;
                            case 'b':
                                this.$router.push('/home');
                            break;

                        }

                    }else if(response.data.status == false){

                        this.validation_2 = true;

                    }else{
                        this.data = response.data;
                        this.validation = true;
                    }
                })
                .catch(e => {
                    console.log(e);
                });
            }

        }
    }
</script>

<style scoped>
    i{
        font-size: 70px;
        margin:50px;
    }
</style>

