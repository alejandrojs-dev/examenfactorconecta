import Vue from "vue";
import Router from "vue-router";
import ListadoUsuarios from "./components/ListadoUsuarios.vue";
import FormularioUsuarios from "./components/FormularioUsuarios.vue";

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: "/",
            name: "usuarios",
            component: ListadoUsuarios
        },
        {
            path: "/formulario",
            name: "formulario",
            component: FormularioUsuarios
        },
        {
            path: "/formulario/:id",
            name: "formulario-editar",
            component: FormularioUsuarios,
            props: {
                default: true
            }
        }
    ],
    mode: "history"
});

export default router;
