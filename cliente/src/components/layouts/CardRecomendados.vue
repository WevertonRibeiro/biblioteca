<template>
    <div class="card mb-3" style="max-width: 250px;float:left;margin:10px;">
  <div class="row no-gutters">
    <div class="col-md-4" style="padding:5px;">
        <img :src="image" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h6 class="card-title">{{title}}</h6>
        <button type="button" class="btn btn-info btn-sm">Reservar</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    name: 'CardRecomendados',
    props:[
        'image', 'title'
    ],
    data() {
        return {

        }
    }
}
</script>

<style scoped>
   
</style>


