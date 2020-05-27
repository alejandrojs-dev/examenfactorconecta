<template>
    <div>
        <h3>Listado de usuarios</h3>
        <router-link :to="{ name: 'formulario' }"
            ><button id="btnAgregar" class="btn btn-primary">
                Agregar usuario
            </button></router-link
        >
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nick</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Correo</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="usuario in usuarios" :key="usuario.id">
                        <td>{{ usuario.nick }}</td>
                        <td>{{ usuario.nombre }}</td>
                        <td>{{ usuario.apellidos }}</td>
                        <td>{{ usuario.roles[0].nombre }}</td>
                        <td>{{ usuario.correo }}</td>
                        <td>
                            <router-link
                                :to="{
                                    name: 'formulario-editar',
                                    params: { id: usuario.id }
                                }"
                                ><button id="btnEditar" class="btn btn-success">
                                    Editar
                                </button></router-link
                            >
                        </td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="eliminarUsuario(usuario.id)"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <nav>
                <ul class="pagination">
                    <ul class="pagination">
                        <li
                            class="page-item"
                            v-if="pagination.current_page > 1"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="
                                    cambiarPagina(pagination.current_page - 1)
                                "
                                >Atrás</a
                            >
                        </li>
                        <li
                            class="page-item"
                            v-for="pagina in numeroPaginas"
                            :key="pagina"
                            :class="[pagina == estaActiva ? 'active' : '']"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="cambiarPagina(pagina)"
                                >{{ pagina }}</a
                            >
                        </li>
                        <li
                            class="page-item"
                            v-if="
                                pagination.current_page < pagination.last_page
                            "
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="
                                    cambiarPagina(pagination.current_page + 1)
                                "
                                >Siguiente</a
                            >
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import config from "../../config/app";
import Swal from "sweetalert2";
export default {
    name: "ListadoUsuarios",
    data() {
        return {
            usuarios: null,
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3
        };
    },
    computed: {
        estaActiva() {
            return this.pagination.current_page;
        },
        numeroPaginas() {
            if (!this.pagination.current_page) {
                return [];
            }

            let from = this.pagination.current_page - 2;
            if (from < 1) {
                from = 1;
            }

            let to = from + 2 * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            let arregloPaginas = [];

            while (from <= to) {
                arregloPaginas.push(from);
                from++;
            }

            return arregloPaginas;
        }
    },
    methods: {
        async obtenerUsuarios(pagina = 1) {
            try {
                const { data } = await axios.get(
                    `${config.host}/usuarios?page=${pagina}`
                );
                if (data.ok) {
                    this.usuarios = data.usuarios;
                    this.pagination = data.pagination;
                }
            } catch (error) {
                console.log(error.response);
            }
        },
        async eliminarUsuario(id) {
            try {
                const result = await Swal.fire({
                    title: "¿Está seguro que desea eliminar al usuario?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Aceptar"
                });

                if (result.value) {
                    const { data } = await axios.delete(
                        `${config.host}/usuarios/${id}`
                    );

                    if (data.ok) {
                        await this.obtenerUsuarios();

                        Swal.fire({
                            icon: "success",
                            title: "Éxito",
                            text: data.message
                        });
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        async cambiarPagina(pagina) {
            this.pagination.current_page = pagina;
            await this.obtenerUsuarios(pagina);
        }
    },
    async created() {
        await this.obtenerUsuarios();
    }
};
</script>
<style scoped>
.container {
    margin-top: 5px;
}

h3 {
    text-align: center;
    margin-top: 50px;
}

.table {
    text-align: center;
}

button#btnAgregar {
    margin-left: 150px;
}
</style>
