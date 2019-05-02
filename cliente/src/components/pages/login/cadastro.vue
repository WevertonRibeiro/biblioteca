<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" align="center" style="padding:50px;">
                <div>
                    <i class="fas fa-book-open"></i>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Resgistrar</button>
                        <div class="form-group" style="margin:30px 10px;">
                            <span class="form-text float-left">
                                Ja tem uma conta?
                            </span>
                            <router-link to="/login">
                                <button type="button" class="btn btn-outline-primary btn-sm float-right">Entrar</button>
                            </router-link>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cadastro',
    data() {
        return {
            cadastro:true
        }
    }
}
</script>

<style scoped>
    i{
        font-size: 70px;
        margin:50px;
    }
</style>