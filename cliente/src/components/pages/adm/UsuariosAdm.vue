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
            <div class="row" style="padding:50px;">
                <div class="col-4">
                    <div class="input-group mb-3 float-left" style="width:200px;margin-right:10px;">
                        <input type="text" class="form-control" placeholder="Pesquisar Usuarios">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <router-link to="/adm/novo">
                    <button class="btn btn-primary float-left"><i class="fas fa-plus"></i> Novo</button>
                    </router-link>
                </div>
            </div>
            <table class="table table-striped table-bordered" style="background:white;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td class="align-middle"><small>{{ user.name }}</small></td>
                        <td class="align-middle"><small>{{ user.email }}</small></td>
                        <td class="align-middle"><small>{{ user.tipo }}</small></td>
                        <td class="align-middle"><small>{{ user.endereco }}</small></td>
                        <td class="align-middle"><small>{{ user.telefone }}</small></td>
                        <td class="align-middle"><small>{{ user.cpf }}</small></td>
                        <td class="align-middle">
                            <router-link :to="'/adm/update/'+user.id">
                                <button class="btn btn-info btn-sm"><i class="fas fa-pen"></i></button>
                            </router-link>
                            <button class="btn btn-danger btn-sm" v-on:click="deletar(user.id)"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </LeitorTemplate>
</template>

<script>

    import axios from 'axios';
    import LeitorTemplate from '@/components/templates/LeitorTemplate'
    import MenuLateral from '@/components/layouts/MenuLateral';    

    export default {
        name: 'UsuariosAdm',
        props:[],
        components:{
            LeitorTemplate,
            MenuLateral
        },
        
        data(){
            return {

                object: [
                    {
                    id: 1,
                    firstName: 'Zé',
                    lastName: 'Ninguém',
                    age: 30
                },
                {
                    id: 2,
                    firstName: 'Zé',
                    lastName: 'Ninguém',
                    age: 30
                }
                ],

                users:{}

            }
        },
        methods:{

            deletar(usuario){
                if(confirm("Essa ação não podera ser desfeita! Tem certeza?")){
                    axios.delete(`http://localhost:8000/api/deleteusuario/${usuario}`, {
                
                    })
                    .then(response => {

                        axios.get(`http://localhost:8000/api/usuarios`, {
                    
                        })
                        .then(response => {
                            this.users = response.data;
                        })
                        .catch(e => {
                            console.log(e);
                        });

                        alert("Usuario deletado com sucesso!");

                    })
                    .catch(e => {
                        console.log(e);
                    });
                }
                
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

            axios.get(`http://localhost:8000/api/usuarios`, {
                
            })
            .then(response => {
                this.users = response.data;
            })
            .catch(e => {
                console.log(e);
            });

        }

    }
</script>

<style scoped>

</style>


