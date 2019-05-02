<template>
    <LeitorTemplate>
        <div slot="menu">
            <MenuLateral>
                <li class="MenuItem">
                    <router-link to="/adm/home">
                        <i class="fas fa-home"></i>
                        <span style="margin-left:15px;">Home</span>
                    </router-link>
                </li>
                <li class="MenuItem">
                    <router-link to="/adm/livros">
                        <i class="fas fa-book-open"></i>
                        <span style="margin-left:15px;">Livros</span>
                    </router-link>
                </li>
                <li class="MenuItem" style="border-left:solid 5px #20c997;">
                    <router-link to="/adm/usuarios">
                        <i class="fas fa-user"></i>
                        <span style="margin-left:15px;">Usuarios</span>
                    </router-link>
                </li>
            </MenuLateral>
        </div>
        <div slot="conteudo">
            <div class="container">
                <div class="row" style="padding:20px;">
                    <div class="col">
                        <label for="">Nome:</label><br>
                        <input type="text" v-model="name"><br>
                        <label for="">email::</label><br>
                        <input type="text" v-model="email"><br>
                        <label for="">senha:</label><br>
                        <input type="text" v-model="password"><br>
                        <label for="">Confirmar senha:</label><br>
                        <input type="text" v-model="password_confirmation"><br>
                        <label for="">Tipo:</label><br>
                        <select v-model="tipo">
                            <option value="b">Leitor</option>
                            <option value="a">Atendente</option>
                            <option value="s">Administrador</option>
                        </select><br>
                        <label for="">Endereço:</label><br>
                        <input type="text" v-model="endereco"><br>
                        <label for="">Telefone:</label><br>
                        <input type="text" v-model="telefone"><br>
                        <label for="">CPF:</label><br>
                        <input type="text" v-model="cpf"><br>
                        <button v-on:click="cadastrar()" class="btn btn-primary" style="margin-top:10px;">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </LeitorTemplate>
</template>

<script>

    import axios from 'axios';
    import LeitorTemplate from '@/components/templates/LeitorTemplate'
    import MenuLateral from '@/components/layouts/MenuLateral' 

    export default {
        name: 'HomeAdm',
        props:[],
        components:{
            LeitorTemplate,
            MenuLateral
        },
        data() {
            return {
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
                tipo:'',
                endereco:'',
                telefone:'',
                cpf:''
            }
        },
        methods:{

            cadastrar(){
                axios.post(`http://localhost:8000/api/cadastro`, {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    tipo: this.tipo,
                    endereco: this.endereco,
                    telefone: this.telefone,
                    cpf: this.cpf
                })
                .then(response => {
                    if(response.data.token){
                        alert("Usuario Adicioado com sucesso!");
                        this.$router.push('/adm/usuarios');
                    }else{
                        alert("Erro desconhecido.");
                    }
                })
                .catch(e => {
                    console.log(e);
                });
            }

        },
        created(){

            let usuario = sessionStorage.getItem('usuario');

            if(usuario){

                this.usuario = JSON.parse(usuario);

                switch(this.usuario.tipo){

                    case 's':
                        
                    break;
                    case 'a':
                        this.$router.push('/atendete/home');
                    break;
                    case 'b':
                        this.$router.push('/home');
                    break;

                }

            }else{
                this.$router.push('/login');
            }

        }
        
    }
</script>

<style scoped>

</style>


