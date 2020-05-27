<template>
    <div>
        <h3>Formulario de usuarios</h3>
        <div class="container" v-if="!isEditing">
            <form v-on:submit.prevent="guardarUsuario()">
                <div class="form-group">
                    <label for="nick">Nick</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nick"
                        placeholder="Ingrese nick"
                        autocomplete="off"
                        v-model="usuario.nick"
                    />
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        placeholder="Ingrese nombre"
                        autocomplete="off"
                        v-model="usuario.nombre"
                    />
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input
                        type="text"
                        class="form-control"
                        id="apellidos"
                        placeholder="Ingrese apellidos"
                        autocomplete="off"
                        v-model="usuario.apellidos"
                    />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="Ingrese contraseña"
                        v-model="usuario.password"
                    />
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label>
                    <select class="form-control" id="roles" v-model="selected">
                        <option disabled value="">Selecciona un rol</option>
                        <option
                            v-for="rol in roles"
                            :key="rol.id"
                            :value="rol.id"
                            >{{ rol.nombre }}</option
                        >
                    </select>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input
                        type="email"
                        class="form-control"
                        id="correo"
                        placeholder="Ingrese correo"
                        v-model="usuario.correo"
                    />
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button
                            type="submit"
                            id="btnAceptar"
                            class="btn btn-primary text-center"
                            v-if="!isEditing"
                        >
                            Aceptar
                        </button>
                        <button
                            v-else
                            type="submit"
                            id="btnEditar"
                            class="btn btn-success text-center"
                        >
                            Editar
                        </button>
                        <router-link :to="{ name: 'usuarios' }"
                            ><button id="btnRegresar" class="btn btn-danger">
                                Regresar
                            </button></router-link
                        >
                    </div>
                </div>
            </form>
        </div>

        <div class="container" v-if="isEditing">
            <form v-on:submit.prevent="actualizarUsuario()">
                <div class="form-group">
                    <label for="nick">Nick</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nick"
                        placeholder="Ingrese nick"
                        autocomplete="off"
                        v-model="usuario.nick"
                    />
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        placeholder="Ingrese nombre"
                        autocomplete="off"
                        v-model="usuario.nombre"
                    />
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input
                        type="text"
                        class="form-control"
                        id="apellidos"
                        placeholder="Ingrese apellidos"
                        autocomplete="off"
                        v-model="usuario.apellidos"
                    />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="Ingrese contraseña"
                        v-model="usuario.password"
                    />
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label>
                    <select class="form-control" id="roles" v-model="selected">
                        <option disabled value="">Selecciona un rol</option>
                        <option
                            v-for="rol in roles"
                            :key="rol.id"
                            :value="rol.id"
                            >{{ rol.nombre }}</option
                        >
                    </select>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input
                        type="email"
                        class="form-control"
                        id="correo"
                        placeholder="Ingrese correo"
                        v-model="usuario.correo"
                    />
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button
                            type="submit"
                            id="btnAceptar"
                            class="btn btn-primary text-center"
                            v-if="!isEditing"
                        >
                            Aceptar
                        </button>
                        <button
                            v-else
                            type="submit"
                            id="btnEditar"
                            class="btn btn-success text-center"
                        >
                            Editar
                        </button>
                        <router-link :to="{ name: 'usuarios' }"
                            ><button id="btnRegresar" class="btn btn-danger">
                                Regresar
                            </button></router-link
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import config from "../../config/app";
import Swal from "sweetalert2";
export default {
    name: "FormularioUsuarios",
    data() {
        return {
            usuario: {
                nick: "",
                nombre: "",
                apellidos: "",
                password: "",
                rol_id: 0,
                correo: ""
            },
            roles: null,
            selected: "",
            isEditing: false
        };
    },
    methods: {
        limpiarCampos() {
            this.usuario.nick = "";
            this.usuario.nombre = "";
            this.usuario.apellidos = "";
            this.usuario.password = "";
            this.usuario.correo = "";
            this.selected = "";
        },
        async actualizarUsuario() {
            this.usuario.rol_id = this.selected;
            try {
                const { id } = this.$route.params;
                const { data } = await axios.put(
                    `${config.host}/usuarios/${id}`,
                    this.usuario
                );

                if (data.ok) {
                    this.limpiarCampos();
                    Swal.fire({
                        icon: "success",
                        title: "Éxito",
                        text: data.message
                    });
                }
            } catch (error) {
                const { errors } = error.response.data;
                let message = "";
                for (let e in errors) {
                    message += `${errors[e][0]} </br>`;
                }
                Swal.fire({
                    title: "Ooops...",
                    icon: "info",
                    html: message
                });
            }
        },
        async guardarUsuario() {
            this.usuario.rol_id = this.selected;
            try {
                const { data } = await axios.post(
                    `${config.host}/usuarios`,
                    this.usuario
                );

                if (data.ok) {
                    this.limpiarCampos();
                    Swal.fire({
                        icon: "success",
                        title: "Éxito",
                        text: data.message
                    });
                }
            } catch (error) {
                const { errors } = error.response.data;
                let message = "";
                for (let e in errors) {
                    message += `${errors[e][0]} </br>`;
                }
                Swal.fire({
                    title: "Ooops...",
                    icon: "info",
                    html: message
                });
            }
        },
        async obtenerRoles() {
            try {
                const { data } = await axios.get(`${config.host}/roles`);
                if (data.ok) {
                    this.roles = data.roles;
                }
            } catch (error) {
                const { errors } = error.response.data;
                console.log(errors);
            }
        },
        async llenarFormulario(id) {
            try {
                const { data } = await axios.get(
                    `${config.host}/usuarios/${id}`
                );

                if (data.ok) {
                    this.usuario.nick = data.usuario.nick;
                    this.usuario.nombre = data.usuario.nombre;
                    this.usuario.apellidos = data.usuario.apellidos;
                    this.usuario.password = data.usuario.password;
                    this.usuario.correo = data.usuario.correo;
                    this.selected = data.usuario.roles[0].id;
                }
            } catch (error) {
                console.log(error.response);
            }
        }
    },
    async created() {
        await this.obtenerRoles();
        if (this.$route.params.id) {
            const { id } = this.$route.params;
            await this.llenarFormulario(id);
            this.isEditing = true;
        }
    }
};
</script>
<style scoped>
.container {
    border: 1px solid gray;
    margin: 0 auto;
    margin-top: 5px;
    width: 30%;
    border-radius: 5px;
    padding: 15px;
}
h3 {
    text-align: center;
}
</style>
