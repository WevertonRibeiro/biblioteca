<template>
    
    <LeitorTemplate>
        <div slot="menu">
            <MenuLateral>
                <li class="MenuItem" style="border-left:solid 5px #20c997;">
                    <router-link to="/home">
                        <i class="fas fa-home"></i>
                        <span style="margin-left:15px;">Home</span>
                    </router-link>
                </li>
                <li class="MenuItem">
                    <router-link to="/livros">
                        <i class="fas fa-book-open"></i>
                        <span style="margin-left:15px;">Livros</span>
                    </router-link>
                </li>
            </MenuLateral>
        </div>
        <div slot="conteudo">
            <div class="row" style="padding:50px 30px 10px 30px;">
                Recomendados
            </div>
            <div class="row">
                <div class="col-12">
                    <CardRecomendados 
                        image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10506358&qld=90&l=430&a=-1=1007031694"
                        title="Senhora Do Fogo"
                        />
                    <CardRecomendados 
                        image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10505612&qld=90&l=430&a=-1=1006736459"
                        title="A Cinco Passos De Você"
                        />
                    <CardRecomendados 
                        image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10506043&qld=90&l=430&a=-1=1006718667"
                        title="Varias Cinzas Na Neve"
                        />
                    <CardRecomendados 
                        image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10504397&qld=90&l=430&a=-1=1006715015"
                        title="Um Estranho Irresistível"
                        />
                </div>
            </div>
            <div class="row" style="padding:10px;">
                <div class="col-12">
                
                    <table class="table table-striped table-bordered" style="background:white;">
                        <thead>
                            <tr>
                            <th scope="col">Livro</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reserva in reservas" :key="reserva.id">
                                <td scope="row">
                                    <img :src="reserva.imagem" width="50px">
                                    {{reserva.titulo}}
                                </td>
                                <td class="align-middle" v-if=" reserva.status == 'R' ">Reservado</td>
                                <td class="align-middle" v-if=" reserva.status == 'A' ">Alugado</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-danger" v-if=" reserva.status == 'R' " v-on:click="cancelar(reserva.id, reserva.livro_id)">
                                        Cancelar <i class="fas fa-times"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" v-if=" reserva.status == 'A' " disabled>
                                        Cancelar <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </LeitorTemplate>

</template>

<script>

    import axios from 'axios';
    import LeitorTemplate from '@/components/templates/LeitorTemplate';
    import CardRecomendados from '@/components/layouts/CardRecomendados';
    import MenuLateral from '@/components/layouts/MenuLateral';

    export default {
        name: 'home',
        components:{
            LeitorTemplate,
            CardRecomendados,
            MenuLateral
        },
        data () {
            return {
                reservas:{}
            }
        },
        methods:{

            cancelar(reserva, livro){

                if(confirm("Sua reserva sera cancelada. Tem certeza?")){

                    axios.post(`http://localhost:8000/api/cancelar/reserva`, {
                    
                        reservaId: reserva,
                        livroId: livro

                    })
                    .then(response => {
                        axios.delete(`http://localhost:8000/api/delete/reserva/${response.data}`, {

                        })
                        .then(response => {
                            axios.get(`http://localhost:8000/api/reservas/${this.usuario.id}`, {
                    
                            })
                            .then(response => {
                                alert("Reserva cancelada com sucesso.");
                                this.reservas = response.data;
                            })
                            .catch(e => {
                                console.log(e);
                            });
                        })
                        .catch(e => {
                            console.log(e);
                        });
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

            axios.get(`http://localhost:8000/api/reservas/${this.usuario.id}`, {
                
            })
            .then(response => {
                this.reservas = response.data;
            })
            .catch(e => {
                console.log(e);
            });

        }
    }

</script>

<style scoped>
    
</style>


