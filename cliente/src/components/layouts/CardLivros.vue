<template>
    <div class="card mb-3" style="max-width: 490px; float:left;margin:50px 15px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img :src="image" class="card-img" id="img-card" style="margin:-20px 15px 15px 15px;width:170px;height:250px;">
            </div>
            <div class="col-md-8" style="padding-left:15px;">
                <div class="card-body">
                    <h5 class="card-title">{{title}}</h5>
                    <p class="card-text">{{description}}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            <span class="text-success">
                                <slot name="status"></slot>
                            </span>
                        </small>
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent text-right">
            <button type="button" class="btn btn-info">Reservar</button>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'CardLivros',
        props:[
            'image','title','description'
        ],
        components:{
            
        },
        data () {
            return {

            }
        }
    }
</script>

<style scoped>
    #img-card{
        box-shadow:0px 0px 10px rgba(0, 0, 0, 0.5);
    }
</style>


