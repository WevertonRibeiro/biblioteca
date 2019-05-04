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
                <li class="MenuItem" style="border-left:solid 5px #20c997;">
                    <router-link to="/adm/livros">
                        <i class="fas fa-book-open"></i>
                        <span style="margin-left:15px;">Livros</span>
                    </router-link>
                </li>
                <li class="MenuItem">
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
                        <input type="text" class="form-control" placeholder="Pesquisar livros">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <router-link to="novo-livro">
                        <button class="btn btn-primary float-left"><i class="fas fa-plus"></i> Novo</button>
                    </router-link>
                </div>
            </div>
            <table class="table table-striped table-bordered" style="background:white;">
                <thead>
                    <tr>
                        <th style="width:20%;">Titulo</th>
                        <th style="width:40%;">Descrição</th>
                        <th>Ano</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="livro in livros" :key="livro.id">
                        <td class="align-middle">{{livro.titulo}}</td>
                        <td>{{livro.descricao}}</td>
                        <td class="align-middle">{{livro.ano}}</td>
                        <td class="align-middle">{{livro.autor}}</td>
                        <td class="align-middle">{{livro.editora}}</td>
                        <td><img :src="livro.imagem" style="width:50px;"></td>
                        <td class="align-middle">
                            <button class="btn btn-info btn-sm"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </LeitorTemplate>
</template>

<script>

    import axios from 'axios'
    import LeitorTemplate from '@/components/templates/LeitorTemplate'
    import MenuLateral from '@/components/layouts/MenuLateral';    

    export default {
        name: 'LivrosAdm',
        props:[],
        components:{
            LeitorTemplate,
            MenuLateral
        },
        data() {
            return {
                livros:{}
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

            axios.get(`http://localhost:8000/api/livros`, {
                
            })
            .then(response => {
                this.livros = response.data;
            })
            .catch(e => {
                console.log(e);
            });

        }
    }
</script>

<style scoped>

</style>


