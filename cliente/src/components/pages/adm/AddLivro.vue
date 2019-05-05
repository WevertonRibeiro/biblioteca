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
            <div class="container">
                <div class="row" style="padding:20px;">
                    <div class="col">
                        <label for="">Titulo:</label><br>
                        <input type="text" v-model="titulo"><br>
                        <label for="">Descrição:</label><br>
                        <textarea cols="30" rows="6" v-model="descricao"></textarea><br>
                        <label for="">Ano:</label><br>
                        <input type="text" v-model="ano"><br>
                        <label for="">Autor:</label><br>
                        <input type="text" v-model="autor"><br>
                        <label for="">Editora:</label><br>
                        <input type="text" v-model="editora"><br>
                        <label for="">Status:</label><br>
                        <select v-model="status">
                            <option value="D">Disponivel</option>
                            <option value="R">Reservado</option>
                            <option value="A">Alugado</option>
                        </select>
                        <label for="">Imagem:</label><br>
                        <input type="file" v-on:change="getBase64" disabled/><br>
                        <router-link to="/adm/livros">
                            <button class="btn btn-success" style="margin-top:10px;">Voltar</button>
                        </router-link>
                        <button v-on:click="cadastrar()" class="btn btn-primary" style="margin-top:10px;">Salvar</button>
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
                titulo:'',
                descricao:'',
                ano:'',
                autor:'',
                editora:'',
                status:'',
                imagem:''
            }
        },
        methods:{

            getBase64(e){

                let arquivo = e.target.files || e.dataTransfer.files;

                if (arquivo.length > 0) {

                    var reader = new FileReader();
                    reader.readAsDataURL(arquivo[0]);

                    reader.onload = function () {
                        this.imagem = reader.result;
                        console.log(this.imagem);
                    }

                    reader.onerror = function (error) {
                        console.log('Error: ', error);
                    }

                }

            },

            cadastrar(){

                
                axios.post(`http://localhost:8000/api/cadastro/livro`, {

                    titulo: this.titulo,
                    descricao: this.descricao,
                    ano: this.ano,
                    autor: this.autor,
                    editora: this.editora,
                    status: this.status,
                    imagem: 'https://www.tornado-studios.com/sites/default/files/styles/slider_full/public/products/1256/gallery/classic_book_01_standing_open_thumbnail_square_0000.jpg?itok=Rrfo0kt2'

                })
                .then(response => {
                    
                    alert("Livro Adicionado com sucesso");

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