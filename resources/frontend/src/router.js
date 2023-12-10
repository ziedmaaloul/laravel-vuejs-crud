import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);

export default new Router({
    linkExactActiveClass: "active",
    mode: 'history',
    routes: [
        {
            path: "/",
            name: "home",
            component: () => import('./views/FilmList.vue'),
        },
        {
            path: "/films/list",
            name: "filmlist",
            component: () => import('./views/FilmList.vue'),
        },
        {
            path: "/films/create",
            name: "filmcreate",
            component: () => import('./views/FilmCreate.vue'),
        },
        {
            path: "/films/show/:id",
            name: "filmsshow",
            component: () => import('./views/FilmShow.vue'),
        },
        {
            path: "/films/:id/edit",
            name: "filmsupdate",
            component: () => import('./views/FilmUpdate.vue'),
        },
    ],

});
