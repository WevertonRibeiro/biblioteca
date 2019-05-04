import Vue from 'vue'
import Router from 'vue-router'

import LivrosLeitor from '@/components/pages/leitor/LivrosLeitor'
import HomeLeitor from '@/components/pages/leitor/HomeLeitor'

import Login from '@/components/pages/login/login'
import Cadastro from '@/components/pages/login/Cadastro'

import HomeAdm from '@/components/pages/adm/HomeAdm'
import LivrosAdm from '@/components/pages/adm/LivrosAdm'
import UsuariosAdm from '@/components/pages/adm/UsuariosAdm'
import AddUsuario from '@/components/pages/adm/AddUsuario'
import UpdateUsuario from '@/components/pages/adm/UpdateUsuario'
import AddLivro from '@/components/pages/adm/AddLivro'
import UpdateLivro from '@/components/pages/adm/UpdateLivro'


Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/adm/novo',
      name: 'NovoUsuario',
      component: AddUsuario
    },
    {
      path: '/adm/livro/update/:id',
      name: 'UpdateLivro',
      component: UpdateLivro
    },
    {
      path: '/adm/update/:id',
      name: 'UpdateUsuario',
      component: UpdateUsuario
    },
    {
      path: '/adm/novo-livro',
      name: 'AddLivro',
      component: AddLivro
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/cadastro',
      name: 'Cadastro',
      component: Cadastro
    },
    {
      path: '/home',
      name: 'HomeLeitor',
      component: HomeLeitor
    },
    {
      path: '/livros',
      name: 'LivrosLeitor',
      component: LivrosLeitor
    },
    {
      path: '/adm/home',
      name: 'HomeAdm',
      component: HomeAdm
    },
    {
      path: '/adm/livros',
      name: 'LivrosAdm',
      component: LivrosAdm
    },
    {
      path: '/adm/usuarios',
      name: 'UsuariosAdm',
      component: UsuariosAdm
    }
  ]
})
