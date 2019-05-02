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
                            <tr>
                                <td scope="row">
                                    <img src="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10504397&qld=90&l=430&a=-1=1006715015" width="50px">
                                    Um Estranho Irresistível
                                </td>
                                <td class="align-middle">Reservado</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-danger">
                                        Cancelar <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">
                                    <img src="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10506043&qld=90&l=430&a=-1=1006718667" width="50px">
                                    Cinzas Na Neve
                                </td>
                                <td class="align-middle">Alugado</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-danger" disabled>
                                        Cancelar <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">
                                    <img src="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10506358&qld=90&l=430&a=-1=1007031694" width="50px">
                                    Senhora Do Fogo
                                </td>
                                <td class="align-middle">Reservado</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-danger">
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

            }
        }
    }

</script>

<style scoped>
    
</style>


