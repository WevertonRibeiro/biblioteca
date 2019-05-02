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
                        <CardLivros 
                            image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10505612&qld=90&l=430&a=-1=1006736459"
                            title="A Cinco Passos De Você"
                            description="Stella Grant gosta de estar no controle. Ela parece ser uma adolescente típica, mas em sua rotina há listas de tarefas e inúmeros remédios que ela deve tomar para"
                            />
                        <CardLivros 
                            image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10506043&qld=90&l=430&a=-1=1006718667"
                            title="Cinzas Na Neve"
                            description="PUBLICADO ORIGINALMENTE COMO A VIDA EM TONS DE CINZA. Cinzas na neve venceu o prêmio Golden Kite e foi adaptado para o cinema em 2018. “Poucos livros são lindamente..."
                            />
                        <CardLivros 
                            image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10506358&qld=90&l=430&a=-1=1007031694"
                            title="Senhora Do Fogo"
                            description="Sinopse da obra ALGUMAS PAIXÕES CURAM. OUTRAS DESTRÕEM. Mehmed está construindo um império, tornando-se o sultão que seu povo precisa. E guarda consigo..."
                            />
                        <CardLivros 
                            image="https://images.livrariasaraiva.com.br/imagemnet/imagem.aspx/?pro_id=10504397&qld=90&l=430&a=-1=1006715015"
                            title="Um Estranho Irresistível"
                            description="Uma mulher que desafia seu tempo Dr. Garret Gibson, a única médica mulher na Inglaterra, é tão ousada e independente quanto qualquer homem – por que não lidar com..."
                            />
                    </div>
                </div>
            </div>
        </div>
    </LeitorTemplate>

</template>

<script>

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

            }
        }
    }
</script>

<style scoped>
    
</style>


