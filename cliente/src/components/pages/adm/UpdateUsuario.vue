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
                        <input type="text" v-model="user.name"><br>
                        <label for="">email::</label><br>
                        <input type="text" v-model="user.email"><br>
                        <label for="">Tipo:</label><br>
                        <select v-model="user.tipo">
                            <option value="b">Leitor</option>
                            <option value="a">Atendente</option>
                            <option value="s">Administrador</option>
                        </select><br>
                        <label for="">Endereço:</label><br>
                        <input type="text" v-model="user.endereco"><br>
                        <label for="">Telefone:</label><br>
                        <input type="text" v-model="user.telefone"><br>
                        <label for="">CPF:</label><br>
                        <input type="text" v-model="user.cpf"><br>
                        <button v-on:click="update()" class="btn btn-primary" style="margin-top:10px;">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </LeitorTemplate>
</template>

<script>

    import axios from 'axios'
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
                user: {}
            }
        },
        methods:{

            update(){

                axios.post(`http://localhost:8000/api/update-usuario`, {
                    id: this.user.id,
                    name: this.user.name,
                    email: this.user.email,
                    tipo: this.user.tipo,
                    endereco: this.user.endereco,
                    telefone: this.user.telefone,
                    cpf: this.user.cpf
                })
                .then(response => {
                    //this.user = response.data;
                    console.log(response.data);
                })
                .catch(e => {
                    console.log(e);
                });

            }

        },
        created(){

            let usuario = sessionStorage.getItem('usuario');
            let userId = this.$route.params.id;

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

            axios.get(`http://localhost:8000/api/usuario/${userId}`, {
                
            })
            .then(response => {
                this.user = response.data;
            })
            .catch(e => {
                console.log(e);
            });

        }
        
    }
</script>

<style scoped>

</style>