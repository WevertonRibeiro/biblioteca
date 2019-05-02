<template>
    <ul class="MenuBar">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-12 text-center title" style="padding-top:20px;">
                {{usuario.name}}
            </div>
            <div class="col-12" style="padding:20px 60px;">
                <img class="img-fluid" src="http://camillacabral.com/wp-content/uploads/2014/04/perfil-blog-redondo-e1397115733470.jpg" alt="">
            </div>
            <div class="col-12 text-center">
                <small class="text-muted">
                    Perfil - <span v-on:click="logout()" style="cursor:pointer;">Sair</span>
                </small>
            </div>
        </div>
        <li class="MenuTitle">
            Menu
        </li>
        <slot />
    </ul>
</template>

<script>
    export default {
        name: 'MenuLateral',
        props: [
            
        ],
        data () {
            return {
                usuario:{}
            }
        },
        methods:{

            logout(){
                sessionStorage.clear();
                this.$router.push('/login');
            }

        },
        created(){

            let usu = sessionStorage.getItem('usuario');
            this.usuario = JSON.parse(usu);

        }
    }
</script>

<style scoped>
    .MenuBar{
        list-style: none;
        padding:0;
        margin:0;
        height:100%;
    }
    .MenuTitle{
        width:100%;
        font-size: 12px;
        padding:10px 12px;
        font-weight: bold;
        letter-spacing: .025em;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        border:solid 1px rgb(255,255,255);
        border-left:solid 5px white;
        color:rgba(51,51,51,0.5);
    }
    .MenuItem{
        width:100%;
        font-size: 12px;
        padding:7px 20px;
        cursor:pointer;
        font-weight: bold;
        letter-spacing: .025em;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        border:solid 1px rgb(255,255,255);
        border-left:solid 5px white;
    }
    .MenuItem:hover{
        border:solid 1px rgba(200,200,200,0.3);
        border-left:solid 5px #20c997;
        background:rgba(200,200,200,0.1);
    }
    .title{
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-weight: bold;
        font-size: 14px;
        color:#495057;
    }
    .ico{
        margin-left:15px;
    }
    a{
        text-decoration:none;
        color:#495057;
    }
</style>