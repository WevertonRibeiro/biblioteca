<template>
    
    <LeitorTemplate>
        <div slot="menu">
            <MenuLateral>
                <li class="MenuItem">
                    <router-link to="/home">
                        <i class="fas fa-home"></i>
                        <span style="margin-left:15px;">Home</span>
                    </router-link>
                </li>
                <li class="MenuItem" style="border-left:solid 5px #20c997;">
                    <router-link to="/livros">
                        <i class="fas fa-book-open"></i>
                        <span style="margin-left:15px;">Livros</span>
                    </router-link>
                </li>
            </MenuLateral>
        </div>
        <div slot="conteudo">
            <div class="container">
                <div class="row" style="padding:50px;">
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Pesquisar livros">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div v-for="livro in livros" :key="livro.id">
                            <CardLivros 
                            :image="livro.imagem"
                            :title="livro.titulo"
                            :description="livro.descricao"
                            >
                            <div slot="status">
                                <span v-bind:class="{'text-success': livro.status == 'D', 'text-danger': livro.status !== 'D'}">
                                    <i class="far fa-check-circle" v-if="livro.status == 'D'"></i>
                                    <i class="fas fa-times" v-if="livro.status !== 'D'"></i>
                                    {{livro.status == 'D'? "Disponivel":"Indisponivel"}}
                                </span>
                            </div>
                            <div slot="btns">
                                <button type="button" class="btn btn-info" v-if="livro.status == 'D'" v-on:click="reservar(livro.id)">Reservar</button>
                                <button type="button" class="btn btn-info" v-if="livro.status !== 'D'" disabled>Reservar</button>
                            </div>
                            </CardLivros>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </LeitorTemplate>

</template>

<script>

    import axios from 'axios'
    import CardLivros from '@/components/layouts/CardLivros';
    import LeitorTemplate from '@/components/templates/LeitorTemplate';
    import MenuLateral from '@/components/layouts/MenuLateral';

    export default {
        name: 'home',
        components:{
            CardLivros,
            LeitorTemplate,
            MenuLateral
        },
        data () {
            return {
                livros:{},
                user:{}
            }
        },
        methods:{

            reservar($idLivro){
                
                axios.post(`http://localhost:8000/api/reservar/livro`, {
                
                    userId: this.user.id,
                    livroId: $idLivro,
                    status: 'R'

                })
                .then(response => {
                    
                    console.log(response.data);

                    axios.get(`http://localhost:8000/api/livros`, {
                
                    })
                    .then(response => {
                        this.livros = response.data;
                    })
                    .catch(e => {
                        console.log(e);
                    });

                    alert("Reservado com sucesso!\nSe em um dia não for retirado na biblioteca voltara a ficar disponivel.");

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
                this.user = JSON.parse(usuario);

                switch(this.usuario.tipo){

                    case 's':
                        this.$router.push('/adm/home');
                    break;
                    case 'a':
                        this.$router.push('/atendete/home');
                    break;
                    case 'b':
                        
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


