<template>
  <div class="container-fluid">
    <div class="row" style="height:768px;">
        <div class="col-2 sidebar">
           <slot name="menu"/>
        </div>
        <div class="col-10 offset-2 main">
            <slot name="conteudo"/>
        </div>
    </div>
  </div>
</template>

<script>

  export default {

    name: 'App',
    components:{

    }
  }
</script>

<style>
  .sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 1000;
    display: block;
    padding: 0px;
    overflow-x: hidden;
    overflow-y: auto;
    background-color: white;
    border-right: 1px solid #eee;
  }
</style>
